<?php

namespace Database\Seeders;

use App\Models\Comments;
use App\Models\LandingPost;
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
                'value' => '/front/dist/images/logos/logo-mely-horizontal.png',
                'created_by' => 1,
            ),
            array(
                'name' => "company_favicon",
                'value' => '/front/dist/images/logos/favicon.svg',
                'created_by' => 1,
            ),
            array(
                'name' => "company_side_logo_dark",
                'value' => '/back/dist/images/logos/logo-mely-horizontal.webp',
                'created_by' => 1,
            ),
            // array(
            //     'name' => "company_side_logo_dark",
            //     'value' => '/front/dist/images/logos/logo-dark.svg',
            //     'created_by' => 1,
            // ),
            array(
                'name' => "company_side_logo_white",
                'value' => '/front/dist/images/logos/logo-white.svg',
                'created_by' => 1,
            ),
            array(
                'name' => "title_text",
                'value' => 'Evarindo',
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
                'name' => "vender_prefix",
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
                'value' => ' ',
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
                'value' => 'PT. Evarindo',
                'created_by' => 1,
            ),
            array(
                'name' => "company_address",
                'value' => 'Jalan Raya Cangkringmalang km. 40, Beji',
                'created_by' => 1,
            ),
            array(
                'name' => "company_city",
                'value' => 'Pasuruan',
                'created_by' => 1,
            ),
            array(
                'name' => "company_state",
                'value' => 'East Java',
                'created_by' => 1,
            ),
            array(
                'name' => "company_zipcode",
                'value' => '67154',
                'created_by' => 1,
            ),
            array(
                'name' => "company_country",
                'value' => 'Indonesia',
                'created_by' => 1,
            ),
            array(
                'name' => "company_telephone",
                'value' => '0343656288',
                'created_by' => 1,
            ),
            array(
                'name' => "company_email",
                'value' => 'contact@evarindo.com',
                'created_by' => 1,
            ),
            array(
                'name' => "company_email_from_name",
                'value' => 'notif@evarindo.com',
                'created_by' => 1,
            ),
            array(
                'name' => "registration_number",
                'value' => ' ',
                'created_by' => 1,
            ),
            array(
                'name' => "tax_type",
                'value' => ' ',
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
                'value' => 'PT. Evarindo',
                'created_by' => 1,
            ),
            array(
                'name' => "footer_text_option",
                'value' => 'PT. Evarindo',
                'created_by' => 1,
            ),
            array(
                'name' => "default_language",
                'value' => 'id',
                'created_by' => 1,
            ),
            array(
                'name' => "meta_description",
                'value' => 'PT Evarindo merupakan produsen manufaktur sendal merek melly.',
                'created_by' => 1,
            ),
            array(
                'name' => "meta_keywords",
                'value' => 'sandal, local, local pride, melly, sandal masa kini,',
                'created_by' => 1,
            ),
            array(
                'name' => "setting_profile_url",
                'value' => 'profile.index',
                'created_by' => 1,
            ),
            array(
                'name' => "foot_note_remarks",
                'value' => 'Dev Team',
                'created_by' => 1,
            ),
            array(
                'name' => "head_office_address",
                'value' => 'Jl. Argopuro No. 42 Sawahan	1',
                'created_by' => 1,
            ),
            array(
                'name' => "head_office_city",
                'value' => 'Surabaya',
                'created_by' => 1,
            ),
            array(
                'name' => "head_office_postal_code",
                'value' => '60252',
                'created_by' => 1,
            ),
            array(
                'name' => "head_office_state",
                'value' => 'East Java',
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
                'user_type' => 'admin',
            ),
        );
        User::insert(
            array(
                'name' => 'Nanda',
                'user_name' => 'Nandax',
                'email' => 'user@isp.com',
                'is_active' => 1,
                'password' => bcrypt(12345678),
                'user_type' => 'user',
            ),
        );

        User::insert(
            array(
                'name' => 'user',
                'user_name' => 'user',
                'email' => 'user@gmail.com',
                'is_active' => 1,
                'password' => bcrypt(12345678),
                'user_type' => 'user',
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
