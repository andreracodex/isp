<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Periode;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use Yajra\DataTables\Facades\DataTables;

class OrderDetailController extends Controller
{
    public function view(OrderDetail $orderdetail)
    {
        $orderdetail = OrderDetail::find($orderdetail->id);
        $profile = Setting::all();

        return view('backend.pages.orderdetail.view',
            compact('profile', 'orderdetail')
        );
    }
}
