<?php

namespace App\Http\Controllers;

use App\Imports\CustomerImport;
use App\Models\Customer;
use App\Models\Location;
use App\Models\Order;
use App\Models\Paket;
use App\Models\Regency;
use App\Models\District;
use App\Models\OrderDetail;
use App\Models\Setting;
use App\Models\SettingsWA;
use App\Models\User;
use App\Models\Village;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

use function App\Http\Helpers\convert_phone;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $profile = Setting::all();
        $data_table = Customer::orderBy('nama_customer', 'ASC')->get();
        if ($request->ajax()) {
            return DataTables::of($data_table)
                ->addIndexColumn()
                ->editColumn('cust_id', function (Customer $cust) {
                    return $cust->id;
                })
                ->addColumn('action', function (Customer $cust) {
                    return "
                <a href=" . route('customer.view', $cust->id) . " class='avtar avtar-xs btn-link-success btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='View Data'><i class='fa fa-eye'></i></a>
                <a href=" . route('customer.edit', $cust->id) . " class='avtar avtar-xs btn-link-warning btn-pc-default' type='button' data-container='body' data-bs-toggle='tooltip' data-bs-placement='top' title='Edit Data'><i class='fa fa-pencil-alt'></i></a>
                <button type='button' class='avtar avtar-xs btn-link-danger btn-pc-default hapusCust' data-id='$cust->id'><i class='fa fa-trash-alt'></i></button>
            ";
                })
                ->make(true);
        }
        return view('backend.pages.customer.index', compact('profile'));
    }

    public function create()
    {
        $customer = new Customer;
        $lokasi = Location::all();
        $profile = Setting::all();
        $paket = Paket::all();
        $kotas = Regency::where('province_id', '35')->orderBy('name', 'ASC')->get();
        $districts = Regency::where('province_id')->get();
        $villages = Regency::where('province_id')->get();
        $order = new Order;
        return view(
            'backend.pages.customer.create',
            compact('profile', 'customer', 'lokasi', 'paket', 'order', 'kotas', 'districts', 'villages')
        );
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nama_customer' => 'required',
            'nomor_telephone' => 'required|min:10|max:14',
            'email' => 'required|email:dns|unique:users',
            'installed_date' => 'required',
            'due_date' => 'required',
        ]);

        if (!$validated) {
            return redirect()->route('customer.index')->with('error', 'Property is not valid .');
        } else {
            try {
                $user = User::create([
                    'name' => $request->nama_customer,
                    'user_name' => $request->nama_customer,
                    'email' => $request->email,
                    'password' => bcrypt('12345678'),
                ]);

                $ppn = $request->input('is_ppn');
                if ($ppn == 'ON' || $ppn == 'on') {
                    $is_ppn = 1;
                } else {
                    $is_ppn = 0;
                }

                $active = $request->input('is_active');
                if ($active == 'ON' || $active == 'on') {
                    $is_active = 1;
                } else {
                    $is_active = 0;
                }

                $installed = $request->input('is_installed');
                if ($installed == 'ON' || $installed == 'on') {
                    $is_installed = 1;
                } else {
                    $is_installed = 0;
                }

                $customer = Customer::create([
                    'user_id' => $user->id,
                    'nama_customer' => $request->nama_customer,
                    'nomor_layanan' => mt_rand(10000000, 99999999),
                    'nomor_ktp' => $request->nomor_ktp ?? 0,
                    'gender' => $request->gender,
                    'alamat_customer' => $request->alamat_customer,
                    'kodepos_customer' => $request->kodepos_customer,
                    'nomor_telephone' => preg_replace("/[^0-9,]/", "", $request->nomor_telephone),
                    'kelurahan_id' => $request->kelurahan,
                    'is_active' => $is_active,
                    'is_new' => 1,
                    'is_ppn' => $is_ppn,
                ]);

                $order = Order::create([
                    'customer_id' => $customer->id,
                    'location_id' => $request->lokasi,
                    'paket_id' => $request->paket_internet,
                    'installed_date' => $request->installed_date,
                    'installed_status' => $is_installed,
                    'biaya_pasang' => $request->biaya_pasang,
                ]);

                $due_date = $request->input('due_date');
                // Get the current year
                $currentYear = date('Y');
                // Generate a random number between 1111 and 9999
                $randomNumber = rand(1111, 9999);
                // Concatenate the current year, date, and random number to create the invoice number
                $invoiceNumber = 'INV' . $currentYear . $randomNumber;
                OrderDetail::create([
                    'order_id' => $order->id,
                    'biaya_admin' => 0,
                    'due_date' => $due_date,
                    'is_active' => $is_active,
                    'is_payed' => 1,
                    'ppn' => $is_ppn,
                    'invoice_number' => $invoiceNumber,
                    'uuid' => Str::uuid(64),
                ]);
                $was = SettingsWA::find(6);
                $set = Setting::find(46);
                if ($was->is_active == 1) {
                    // Send WhatsApp message
                    $message = Setting::find(53);
                    // Replace <p> tags with newlines
                    $converted = preg_replace('/<p[^>]*>/', '', $message->value);
                    $converted = preg_replace('/<\/p>/', "\n\n", $converted);

                    // Remove <strong> tags
                    $converted = preg_replace('/<strong[^>]*>/', "*", $converted);
                    $converted = preg_replace('/<\/strong>/', "*", $converted);

                    // Remove <i> tags
                    $converted = preg_replace('/<i[^>]*>/', "_", $converted);
                    $converted = preg_replace('/<\/i>/', "_", $converted);

                    // Remove <br> tags
                    $converted = preg_replace('/<br[^>]*>/', "\n", $converted);
                    $converted = preg_replace('/&nbsp;/', '', $converted);

                    $converted = preg_replace('/%customer%/', $customer->nama_customer, $converted);
                    $converted = preg_replace('/%tanggaldaftar%/', Carbon::parse($order->installed_date)->format('d F Y'), $converted);
                    $converted = preg_replace('/%bulantahun%/', Carbon::parse($order->installed_date)->format('F Y'), $converted);

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                        CURLOPT_URL => 'https://api.fonnte.com/send',
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => array(
                            'target' => convert_phone($customer->nomor_telephone),
                            'message' => $converted,
                            'countryCode' => '62', //optional
                        ),
                        CURLOPT_HTTPHEADER => array(
                            'Authorization: '.$set->value //change TOKEN to your actual token
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                };

                $user = User::find($user->id);
                $user->assignRole(\Spatie\Permission\Models\Role::findByName('User'));

                return redirect()->route('customer.index')->with('success', 'Berhasil Tambah Customer.');
            } catch (Exception $e) {
                return redirect()->back()->with(['error' => 'Check data kembali !' + $e]);
            }
        }
    }

    public function view(Customer $customer)
    {
        $customer = Customer::find($customer->id);
        $lokasi = Location::all();
        $profile = Setting::all();
        $paket = Paket::all();
        $kotas = Regency::where('province_id', '35')->get();
        $districts = District::all();
        $villages = Village::all();
        $order = Order::where('customer_id', $customer->id)->first();

        return view(
            'backend.pages.customer.view',
            compact('profile', 'customer', 'lokasi', 'paket', 'order', 'kotas', 'districts', 'villages')
        );
    }

    public function edit(Customer $customer)
    {
        $customer = Customer::find($customer->id);
        $lokasi = Location::all();
        $profile = Setting::all();
        $paket = Paket::all();
        $kotas = Regency::where('province_id', '35')->get();
        $districts = District::all();
        $villages = Village::all();
        $order = Order::where('customer_id', $customer->id)->first();

        return view(
            'backend.pages.customer.edit',
            compact('profile', 'customer', 'lokasi', 'paket', 'order', 'kotas', 'districts', 'villages')
        );
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'nama_customer' => 'required',
            'nomor_telephone' => 'required|min:10|max:14',
            'nomor_layanan' => 'required|min:7|max:8'
        ]);

        if (!$validated) {
            return redirect()->route('customer.index')->with('error', 'Property is not valid .');
        } else {

            try {

                $ppn = $request->input('is_ppn');
                if ($ppn == 'ON' || $ppn == 'on') {
                    $is_ppn = 1;
                } else {
                    $is_ppn = 0;
                }

                $active = $request->input('is_active');
                if ($active == 'ON' || $active == 'on') {
                    $is_active = 1;
                } else {
                    $is_active = 0;
                }

                $new = $request->input('is_new');
                if ($new == 'ON' || $new == 'on') {
                    $is_new = 1;
                } else {
                    $is_new = 0;
                }

                $installed = $request->input('is_installed');
                if ($installed == 'ON' || $installed == 'on') {
                    $is_installed = 1;
                } else {
                    $is_installed = 0;
                }

                $user = User::find($customer->user_id);
                $user->update([
                    'name' => $request->nama_customer,
                    'email' => $request->email,
                ]);

                $customer->update([
                    'nama_customer' => $request->nama_customer,
                    'nomor_layanan' => $request->nomor_layanan,
                    'nomor_ktp' => $request->nomor_ktp ?? 0,
                    'gender' => $request->gender,
                    'alamat_customer' => $request->alamat_customer,
                    'kodepos_customer' => $request->kodepos_customer,
                    'nomor_telephone' => $request->nomor_telephone,
                    'kelurahan_id' => $request->kelurahan,
                    'is_active' => $is_active,
                    'is_new' => $is_new,
                    'is_ppn' => $is_ppn,
                ]);

                $order = Order::find($request->input('order_id'));
                $order->update([
                    'customer_id' => $customer->id,
                    'location_id' => $request->lokasi,
                    'paket_id' => $request->paket_internet,
                    'biaya_pasang' => $request->biaya_pasang,
                    'installed_date' => $request->installed_date,
                    'installed_status' => $is_installed,
                    'order_date' => Date::now(),
                ]);

                $details = OrderDetail::where('order_id', $order->id)->first();
                $details->update([
                    'due_date' => Date::now(),
                ]);

                return redirect()->route('customer.index')->with('success', 'Berhasil Edit Customer.');
            } catch (Exception $e) {
                return redirect()->back()->with(['error' => 'Check data kembali !']);
            }
        }
    }

    public function import()
    {
        try {
            Excel::import(new CustomerImport, request()->file('file'));
            return redirect()->back()->with('success', 'Customer imported successfully.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            // Handle validation errors
            $failures = $e->failures();
            return redirect()->back()->with('errors', 'Customer import failed due to validation errors.')->withErrors($failures);
        } catch (\Maatwebsite\Excel\Exceptions\NoTypeDetectedException $e) {
            // Handle file type errors
            return redirect()->back()->with('errors', 'Customer import failed due to invalid file type.');
        } catch (Exception $error) {
            // Log the error
            Log::error('Customer import failed: ' . $error->getMessage());
            return redirect()->back()->with('errors', 'Customer import failed.');
        }

    }

    public function delete(String $id)
    {
        $cust = Customer::find($id);
        if ($cust) {
            Customer::where('id', '=', $cust->id)->delete();
            $order = Order::where('customer_id', '=', $cust->id)->first();
            OrderDetail::where('order_id', '=', $order->id)->delete();
            Order::where('customer_id', '=', $cust->id)->delete();
            return redirect()->back()->with(['success' => 'Data berhasil dihapus !']);
        } else {
            return redirect()->back()->with(['error' => 'Data failed dihapus !']);
        }
    }
}
