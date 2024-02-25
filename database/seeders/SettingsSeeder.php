<?php

namespace Database\Seeders;

use App\Models\Comments;
use App\Models\LandingPost;
use App\Models\Location;
use App\Models\Paket;
use App\Models\PaketWa;
use App\Models\Setting;
use App\Models\User;
use App\Models\UserSetting;
use DateTime;
use Egulias\EmailValidator\Parser\Comment;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission as ModelsPermission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Setting::insert(array(
            array(
                'name' => "company_logo",
                'value' => '/images/logo.png',
                'created_by' => 1,
            ),
            array(
                'name' => "company_logo_dark",
                'value' => '/images/logo-dark.png',
                'created_by' => 1,
            ),
            array(
                'name' => "company_favicon",
                'value' => '/images/favicon.ico',
                'created_by' => 1,
            ),
            array(
                'name' => "company_sidebar_logo",
                'value' => '/images/logo.png',
                'created_by' => 1,
            ),
            array(
                'name' => "company_sidebar_logo_dark",
                'value' =>  '/images/logo-dark.png',
                'created_by' => 1,
            ),
            array(
                'name' => "title_text",
                'value' => 'GNet',
                'created_by' => 1,
            ),
            array(
                'name' => "subtitle_text",
                'value' => 'Internet Provider Kesayangan Kamu',
                'created_by' => 1,
            ),
            array(
                'name' => "site_currency",
                'value' => 'IDR',
                'created_by' => 1,
            ),
            array(
                'name' => "site_currency_symbol",
                'value' => 'Rp',
                'created_by' => 1,
            ),
            array(
                'name' => "site_currency_symbol_position",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "site_date_format",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "site_time_format",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "invoice_prefix",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "proposal_prefix",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "bill_prefix",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "customer_prefix",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "vendor_prefix",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "journal_prefix",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "footer_title_notes",
                'value' => '',
                'created_by' => 1,
            ),
            array(
                'name' => "footer_title_notes_2",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "decimal_number",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "shipping_display",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "company_name",
                'value' => 'PT. Global Data Network',
                'created_by' => 1,
            ),
            array(
                'name' => "company_address",
                'value' => 'Jl. Dinoyo Tenun No.109, Keputran, Kec. Tegalsari',
                'created_by' => 1,
            ),
            array(
                'name' => "company_city",
                'value' => 'Surabaya',
                'created_by' => 1,
            ),
            array(
                'name' => "company_state",
                'value' => 'Jawa Timur',
                'created_by' => 1,
            ),
            array(
                'name' => "company_zipcode",
                'value' => '60265',
                'created_by' => 1,
            ),
            array(
                'name' => "company_country",
                'value' => 'Indonesia',
                'created_by' => 1,
            ),
            array(
                'name' => "company_telephone",
                'value' => '(+62)857 3177 0730',
                'created_by' => 1,
            ),
            array(
                'name' => "company_email",
                'value' => 'admin@gnet.co.id',
                'created_by' => 1,
            ),
            array(
                'name' => "company_email_from_name",
                'value' => 'admin@gnet.co.id',
                'created_by' => 1,
            ),
            array(
                'name' => "registration_number",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "tax_type",
                'value' => 'enabled',
                'created_by' => 1,
            ),
            array(
                'name' => "tax_fee",
                'value' => 11, // Nilai besaran pajak
                'created_by' => 1,
            ),
            array(
                'name' => "tax_tempo_date",
                'value' => 20, // Tanggal jatuh tempo tagihan
                'created_by' => 1,
            ),
            array(
                'name' => "tax_date_line",
                'value' => 2, // Tagihan dibuat sebelum hari
                'created_by' => 1,
            ),
            array(
                'name' => "isolir",
                'value' => 1, // Default = 0 Tidak Aktif, 1 = Aktif
                'created_by' => 1,
            ),
            array(
                'name' => "vat_number",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "display_landing_page",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "title_text_option",
                'value' => 'PT. Global Data Network',
                'created_by' => 1,
            ),
            array(
                'name' => "footer_text_option",
                'value' => 'PT. Global Data Network',
                'created_by' => 1,
            ),
            array(
                'name' => "default_language",
                'value' => 'id',
                'created_by' => 1,
            ),
            array(
                'name' => "meta_description",
                'value' => 'PT. Global Data Network - ISP Kesayangan Kamu',
                'created_by' => 1,
            ),
            array(
                'name' => "meta_keywords",
                'value' => 'internet, global, data, network, isp, kesayangan, kamu',
                'created_by' => 1,
            ),
            array(
                'name' => "foot_note_remarks",
                'value' => 'https://berdikari.web.id',
                'created_by' => 1,
            ),
        ));

        Role::insert(array(
            array(
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
            ),
            array(
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
            ),
            array(
                'name' => 'User',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
            ),
            array(
                'name' => 'Api Akses',
                'guard_name' => 'api',
                'created_at' => new DateTime(),
            )
        ));

        ModelsPermission::insert(array(
            // Main Menu
            array(
                'name' => 'menu dashboard',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '1',
            ),
            array(
                'name' => 'menu sales',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '1',
            ),
            array(
                'name' => 'menu customer',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '1',
            ),
            array(
                'name' => 'menu product',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '1',
            ),
            array(
                'name' => 'menu setting',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '1',
            ),
            // Menu Utama
            array(
                'name' => 'show graphicsales',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'show orderstatus',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main salesorder',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main payment',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main customer',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main article',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main category',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main product',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main role',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main permission',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main assign',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main userrole',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main useractivation',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main setting',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
            array(
                'name' => 'main slider',
                'guard_name' => 'web',
                'created_at' => new DateTime(),
                'guard_group' => '2',
            ),
        ));
        User::insert(
            array(
                'name' => 'Administrator',
                'user_name' => 'administ',
                'email' => 'admin@isp.com',
                'is_active' => 1,
                'password' => bcrypt(12345678),
                'path' => '',
                'user_type' => 'admin',
            ),
        );
        UserSetting::insert(
            array(
                'user_id' => 1,
            ),
        );
        User::insert(
            array(
                'name' => 'Nanda',
                'user_name' => 'Nandax',
                'email' => 'user@isp.com',
                'is_active' => 1,
                'password' => bcrypt(12345678),
                'path' => '',
                'user_type' => 'user',
            ),
        );
        // Insert Paket
        Paket::insert(
            array(
                'nama_paket'=> 'Lancar',
                'jenis_paket'=> '1 Mbps',
                'harga_paket'=> rand(100000, 150000),
                'disc'=> 0,
            ),
        );
        Paket::insert(
            array(
                'nama_paket'=> 'Cepat',
                'jenis_paket'=> '2 Mbps',
                'harga_paket'=> rand(100000, 150000),
                'disc'=> 0,
            ),
        );
        Paket::insert(
            array(
                'nama_paket'=> 'Kilat',
                'jenis_paket'=> '3 Mbps',
                'harga_paket'=> rand(100000, 150000),
                'disc'=> 0,
            ),
        );
        Paket::insert(
            array(
                'nama_paket'=> 'Whooosh',
                'jenis_paket'=> '4 Mbps',
                'harga_paket'=> rand(100000, 150000),
                'disc'=> 0,
            ),
        );
        Paket::insert(
            array(
                'nama_paket'=> 'Lightning',
                'jenis_paket'=> '5 Mbps',
                'harga_paket'=> rand(100000, 150000),
                'disc'=> 0,
            ),
        );
        // Paket WA
        PaketWa::insert(
            array(
                'nama_paket'=> 'Free',
                'jenis_paket'=> 'Free',
                'harga_paket'=> 0,
                'disc'=> 0,
                'jumlah_pesan' => 600,
                'is_active' => 1
            ),
        );
        // MIcro
        PaketWa::insert(
            array(
                'nama_paket'=> 'Micro Bussiness',
                'jenis_paket'=> 'Year',
                'harga_paket'=> 250000,
                'duration'=> 12,
                'disc'=> 0,
                'jumlah_pesan' => 5000,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Micro Bussiness',
                'jenis_paket'=> '6 Bulan',
                'harga_paket'=> 170000,
                'duration'=> 6,
                'disc'=> 0,
                'jumlah_pesan' => 5000,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Micro Bussiness',
                'jenis_paket'=> '3 Bulan',
                'harga_paket'=> 100000,
                'duration'=> 3,
                'disc'=> 0,
                'jumlah_pesan' => 5000,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Micro Bussiness',
                'jenis_paket'=> '1 Bulan',
                'harga_paket'=> 35000,
                'duration'=> 1,
                'disc'=> 0,
                'jumlah_pesan' => 5000,
                'is_active' => 1
            ),
        );
        //Small
        PaketWa::insert(
            array(
                'nama_paket'=> 'Small Bussiness',
                'jenis_paket'=> 'Year',
                'harga_paket'=> 500000,
                'duration'=> 12,
                'disc'=> 0,
                'jumlah_pesan' => 10000,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Small Bussiness',
                'jenis_paket'=> '6 Bulan',
                'harga_paket'=> 340000,
                'duration'=> 6,
                'disc'=> 0,
                'jumlah_pesan' => 10000,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Small Bussiness',
                'jenis_paket'=> '3 Bulan',
                'harga_paket'=> 204000,
                'duration'=> 3,
                'disc'=> 0,
                'jumlah_pesan' => 10000,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Small Bussiness',
                'jenis_paket'=> '1 Bulan',
                'harga_paket'=> 75000,
                'duration'=> 1,
                'disc'=> 0,
                'jumlah_pesan' => 10000,
                'is_active' => 1
            ),
        );
        // Medium
        PaketWa::insert(
            array(
                'nama_paket'=> 'Medium Bussiness',
                'jenis_paket'=> 'Year',
                'harga_paket'=> 580000,
                'duration'=> 12,
                'disc'=> 0,
                'jumlah_pesan' => 999999,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Medium Bussiness',
                'jenis_paket'=> '6 Bulan',
                'harga_paket'=> 400000,
                'duration'=> 6,
                'disc'=> 0,
                'jumlah_pesan' => 999999,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Medium Bussiness',
                'jenis_paket'=> '3 Bulan',
                'harga_paket'=> 240000,
                'duration'=> 3,
                'disc'=> 0,
                'jumlah_pesan' => 999999,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Medium Bussiness',
                'jenis_paket'=> '1 Bulan',
                'harga_paket'=> 80000,
                'duration'=> 1,
                'disc'=> 0,
                'jumlah_pesan' => 999999,
                'is_active' => 1
            ),
        );
        // Enteprise
        PaketWa::insert(
            array(
                'nama_paket'=> 'Enterprise Bussiness',
                'jenis_paket'=> 'Year',
                'harga_paket'=> 1000000,
                'duration'=> 12,
                'disc'=> 0,
                'jumlah_pesan' => 999999,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Enterprise Bussiness',
                'jenis_paket'=> '6 Bulan',
                'harga_paket'=> 650000,
                'duration'=> 6,
                'disc'=> 0,
                'jumlah_pesan' => 999999,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Enterprise Bussiness',
                'jenis_paket'=> '3 Bulan',
                'harga_paket'=> 400000,
                'duration'=> 3,
                'disc'=> 0,
                'jumlah_pesan' => 999999,
                'is_active' => 1
            ),
        );
        PaketWa::insert(
            array(
                'nama_paket'=> 'Enterprise Bussiness',
                'jenis_paket'=> '1 Bulan',
                'harga_paket'=> 150000,
                'duration'=> 1,
                'disc'=> 0,
                'jumlah_pesan' => 999999,
                'is_active' => 1
            ),
        );
        UserSetting::insert(
            array(
                'user_id' => 2,
            ),
        );
        User::insert(
            array(
                'name' => 'user',
                'user_name' => 'user',
                'email' => 'user@gmail.com',
                'is_active' => 1,
                'password' => bcrypt(12345678),
                'path' => '',
                'user_type' => 'user',
            ),
        );
        UserSetting::insert(
            array(
                'user_id' => 3,
            ),
        );

        // create permissions
        ModelsPermission::create(['name' => 'view category']);
        ModelsPermission::create(['name' => 'add category']);
        ModelsPermission::create(['name' => 'edit category']);
        ModelsPermission::create(['name' => 'view customer']);
        ModelsPermission::create(['name' => 'add customer']);
        ModelsPermission::create(['name' => 'edit customer']);
        ModelsPermission::create(['name' => 'view order']);
        ModelsPermission::create(['name' => 'view order_partial']);
        ModelsPermission::create(['name' => 'add order']);
        ModelsPermission::create(['name' => 'edit order']);
        ModelsPermission::create(['name' => 'view product']);
        ModelsPermission::create(['name' => 'view product_partial']);
        ModelsPermission::create(['name' => 'add product']);
        ModelsPermission::create(['name' => 'edit product']);
        ModelsPermission::create(['name' => 'edit profile']);
        ModelsPermission::create(['name' => 'view profile']);
        ModelsPermission::create(['name' => 'edit activation']);
        ModelsPermission::create(['name' => 'view activation']);
        ModelsPermission::create(['name' => 'view article']);
        ModelsPermission::create(['name' => 'add article']);
        ModelsPermission::create(['name' => 'edit article']);
        ModelsPermission::create(['name' => 'add payment']);
        ModelsPermission::create(['name' => 'edit payment']);
        ModelsPermission::create(['name' => 'view payment']);
        ModelsPermission::create(['name' => 'add slider']);
        ModelsPermission::create(['name' => 'edit slider']);
        ModelsPermission::create(['name' => 'view slider']);
        ModelsPermission::create(['name' => 'view inventaris']);
        ModelsPermission::create(['name' => 'add inventaris']);
        ModelsPermission::create(['name' => 'edit inventaris']);

        $role2 = Role::find(2);
        $role2->givePermissionTo('menu dashboard');
        $role2->givePermissionTo('menu sales');
        $role2->givePermissionTo('menu product');
        $role2->givePermissionTo('main salesorder');
        $role2->givePermissionTo('view product_partial');
        $role2->givePermissionTo('view order_partial');
        $role2->givePermissionTo('view category');

        // create roles and assign existing permissions
        $role1 = Role::find(3);
        $role1->givePermissionTo('menu dashboard');
        $role1->givePermissionTo('menu sales');
        $role1->givePermissionTo('main salesorder');
        $role1->givePermissionTo('view order');


        $user = User::find(1);
        $user->assignRole(\Spatie\Permission\Models\Role::findByName('Super Admin'));

        $user = User::find(2);
        $user->assignRole(\Spatie\Permission\Models\Role::findByName('User'));

        $user = User::find(3);
        $user->assignRole(\Spatie\Permission\Models\Role::findByName('User'));

        // $user = User::find(4);
        // $user->assignRole(\Spatie\Permission\Models\Role::findByName('User'));
    }
}
