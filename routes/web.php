<?php

use App\Http\Controllers\AddProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BranchLocationController;
use App\Http\Controllers\CableController;
use App\Http\Controllers\CableStockController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientMaterialController;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\DealerCityController;
use App\Http\Controllers\DealerClientController;
use App\Http\Controllers\DealerController;
use App\Http\Controllers\DealerPaymentController;
use App\Http\Controllers\EmployeeClientController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePaymentController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\InstallerController;
use App\Http\Controllers\InverterController;
use App\Http\Controllers\InverterStockController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PurchaseProducController;
use App\Http\Controllers\ReferenceController;
use App\Http\Controllers\SellProductController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WiringAccessoriesController;
use App\Http\Controllers\WiringStockController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::get('/', function () {
    return view('guest.home');
});
// route::view('demo', 'welcome');
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('config:clear');
    return 'DONE'; //Return anything

});


Route::get('/migrate', function () {
    $exitCode1 = Artisan::call('migrate', ['--path' => 'database/migrations/2024_02_22_050029_create_log_infos_table.php']);
    if ($exitCode1 !== 0) {
        return 'Migration 2024_02_22_050029_create_log_infos_table.php failed with exit code: ' . $exitCode1;
    }

    $exitCode2 = Artisan::call('migrate', ['--path' => 'database/migrations/2024_02_21_101733_create_clients_table.php']);
    if ($exitCode2 !== 0) {
        return 'Migration 2024_02_21_101733_create_clients_table.php failed with exit code: ' . $exitCode2;
    }

    $exitCode3 = Artisan::call('migrate');
    if ($exitCode3 !== 0) {
        return 'General migration failed with exit code: ' . $exitCode3;
    }

    return 'All migrations done successfully';
});

// route::view('demo', 'welcome');
Route::prefix('guest')->group(function () {
    Route::get('home', [GuestController::class, 'home'])->name('guest.home');
    Route::get('about', [GuestController::class, 'about'])->name('guest.about');
    Route::get('service', [GuestController::class, 'service'])->name('guest.service');
    Route::get('gallery', [GuestController::class, 'gallery'])->name('guest.gallery');
    Route::get('contact', [GuestController::class, 'contact'])->name('guest.contact');
    Route::get('career', [GuestController::class, 'career'])->name('guest.career');
    Route::get('login', [GuestController::class, 'login'])->name('guest.login');
    Route::get('register', [GuestController::class, 'register'])->name('guest.register');
    Route::get('details/{id}', [GuestController::class, 'details'])->name('guest.details');
    Route::get('branches', [GuestController::class, 'branches'])->name('guest.branches');
    Route::get('branches/{id}/data', [GuestController::class, 'getBranchData'])->name('guest.branch.data');

    // Route::get('branches', function () { return view('guest.Branch'); })->name('guest.branches');
    Route::get('/terms-and-conditions', function () {
        $terms = App\Models\TermsCondition::first();
        return view('guest.terms&condition', compact('terms'));
    })->name('guest.terms&condition');

    // *User
    Route::post('insert_user', [UserController::class, 'insert_user'])->name('guest.insert_user');

    Route::get('forgot_password', [GuestController::class, 'forgot_password'])->name('guest.forgot_password');
    Route::post('forgot_password_form_submit', [GuestController::class, 'forgot_password_form_submit'])->name('guest.forgot_password_form_submit');
    Route::get('verify_forget_pwd_otp/{email}/{token}', [GuestController::class, 'verify_forget_pwd_otp'])->name('guest.verify_forget_pwd_otp');
    Route::post('verify_forget_pwd_otp_action', [GuestController::class, 'verify_forget_pwd_otp_action'])->name('guest.verify_forget_pwd_otp_action');
    Route::post('reset_password', [GuestController::class, 'reset_password'])->name('guest.reset_password');
    Route::post('get_a_quote', [GuestController::class, 'get_a_quote'])->name('guest.get_a_quote');
});

//*Login
Route::post('login_authentication', [LoginController::class, 'login_authentication'])->name('login_authentication');
Route::get('AdminLogout', [LoginController::class, 'AdminLogout'])->name('AdminLogout');
Route::get('EmployeeLogout', [LoginController::class, 'EmployeeLogout'])->name('EmployeeLogout');
Route::get('DealerLogout', [LoginController::class, 'DealerLogout'])->name('DealerLogout');
Route::get('InstallerLogout', [LoginController::class, 'InstallerLogout'])->name('InstallerLogout');

Route::prefix('dealer_ship')->group(function () {
    Route::get('goldi_solar', [GuestController::class, 'goldi_solar'])->name('dealer_ship.goldi_solar');
});

Route::middleware(['LoginAuth'])->group(function () {
    // *ADMIN
    Route::prefix('admin')->group(function () {
        Route::middleware(['AdminAuth'])->group(function () {
            Route::post('info_data', [CommonController::class, 'fetch_data_for_info'])->name('admin.info_data');

            Route::get('dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

            // Route::get('material_report', [AdminController::class, 'material_report'])->name('admin.material_report');



            Route::get('master', [MasterController::class, 'master'])->name('admin.master');
            // *User
            Route::get('add_user', [UserController::class, 'add_user'])->name('admin.add_user');
            Route::post('insert_user', [UserController::class, 'insert_user'])->name('admin.insert_user');
            Route::get('manage_user', [UserController::class, 'manage_user'])->name('admin.manage_user');
            Route::get('edit_user/{id}', [UserController::class, 'edit_user'])->name('admin.edit_user');
            Route::post('update_user', [UserController::class, 'update_user'])->name('admin.update_user');

            Route::get('update_user_status/{id}/{status}', [UserController::class, 'update_user_status'])->name('admin.update_user_status');
            Route::get('delete_user/{id}', [UserController::class, 'delete_user'])->name('admin.delete_user');



            // *Master

            //* Add_product
            Route::get('manage_product', [AddProductController::class, 'manage_product'])->name('admin.manage_product');
            Route::post('insert_product', [AddProductController::class, 'insert_product'])->name('admin.insert_product');

            Route::get('edit_product/{id}', [AddProductController::class, 'edit_product'])->name('admin.edit_product');
            Route::post('update_product', [AddProductController::class, 'update_product'])->name('admin.update_product');

            Route::get('update_product_status/{id}/{status}', [AddProductController::class, 'update_product_status'])->name('admin.update_product_status');
            Route::get('delete_product/{id}', [AddProductController::class, 'delete_product'])->name('admin.delete_product');
            //*

            //* purchase_producs
            Route::get('manage_purchase_producs', [PurchaseProducController::class, 'manage_purchase_producs'])->name('admin.manage_purchase_producs');
            Route::post('insert_purchase_producs', [PurchaseProducController::class, 'insert_purchase_producs'])->name('admin.insert_purchase_producs');

            Route::get('edit_purchase_producs/{id}', [PurchaseProducController::class, 'edit_purchase_producs'])->name('admin.edit_purchase_producs');
            Route::post('update_purchase_producs', [PurchaseProducController::class, 'update_purchase_producs'])->name('admin.update_purchase_producs');

            Route::get('update_purchase_producs_status/{id}/{status}', [PurchaseProducController::class, 'update_purchase_producs_status'])->name('admin.update_purchase_producs_status');
            Route::get('delete_purchase_producs/{id}', [PurchaseProducController::class, 'delete_purchase_producs'])->name('admin.delete_purchase_producs');
            //*

            //* Stock
            // Route::get('manage_stock', [AdminController::class, 'manage_stock'])->name('admin.manage_stock');

            Route::get('manage_stock', [StockController::class, 'manage_stock'])->name('admin.manage_stock');
            Route::post('insert_stock', [StockController::class, 'insert_stock'])->name('admin.insert_stock');

            Route::get('edit_stock/{id}', [StockController::class, 'edit_stock'])->name('admin.edit_stock');
            Route::post('update_stock', [StockController::class, 'update_stock'])->name('admin.update_stock');

            Route::get('material_report', [StockController::class, 'material_report'])->name('admin.material_report');

            Route::get('update_stock_status/{id}/{status}', [StockController::class, 'update_stock_status'])->name('admin.update_stock_status');
            Route::get('delete_stock/{id}', [StockController::class, 'delete_stock'])->name('admin.delete_stock');
            //*

            // *SellProduct
            Route::get('add_material', [SellProductController::class, 'add_material'])->name('admin.add_material');
            Route::post('insert_material', [SellProductController::class, 'insert_material'])->name('admin.insert_material');

            Route::post('insert_material_coform_data', [SellProductController::class, 'insert_material_coform_data'])->name('admin.insert_material_coform_data');

            Route::get('sell_product_demo_datas_delete/{id}', [SellProductController::class, 'sell_product_demo_datas_delete'])->name('admin.sell_product_demo_datas_delete');
            //*


            //* Structure
            Route::get('manage_structure', [StructureController::class, 'manage_structure'])->name('admin.manage_structure');
            Route::post('insert_structure', [StructureController::class, 'insert_structure'])->name('admin.insert_structure');

            Route::get('edit_structure/{id}', [StructureController::class, 'edit_structure'])->name('admin.edit_structure');
            Route::post('update_structure', [StructureController::class, 'update_structure'])->name('admin.update_structure');

            Route::get('update_structure_status/{id}/{status}', [StructureController::class, 'update_structure_status'])->name('admin.update_structure_status');
            Route::get('delete_structure/{id}', [StructureController::class, 'delete_structure'])->name('admin.delete_structure');
            //*

            //* Structure Stock
            Route::get('manage_structure_stock', [StructureController::class, 'manage_structure_stock'])->name('admin.manage_structure_stock');
            Route::get('getStructures', [StructureController::class, 'getStructures'])->name('admin.getStructures');
            Route::post('insert_structure_stock', [StructureController::class, 'insert_structure_stock'])->name('admin.insert_structure_stock');

            Route::get('edit_structure_stock/{id}', [StructureController::class, 'edit_structure_stock'])->name('admin.edit_structure_stock');
            Route::post('update_structure_stock', [StructureController::class, 'update_structure_stock'])->name('admin.update_structure_stock');

            Route::get('update_structure__stock_status/{id}/{status}', [StructureController::class, 'update_structure_stock_status'])->name('admin.update_structure_stock_status');
            Route::get('delete_structure_stock/{id}', [StructureController::class, 'delete_structure_stock'])->name('admin.delete_structure_stock');
            //*

            //* Wiring Accessories
            Route::get('manage_wiring_accessories', [WiringAccessoriesController::class, 'manage_wiring_accessories'])->name('admin.manage_wiring_accessories');
            Route::post('insert_wiring_accessories', [WiringAccessoriesController::class, 'insert_wiring_accessories'])->name('admin.insert_wiring_accessories');

            Route::get('edit_wiring_accessories/{id}', [WiringAccessoriesController::class, 'edit_wiring_accessories'])->name('admin.edit_wiring_accessories');
            Route::post('update_wiring_accessories', [WiringAccessoriesController::class, 'update_wiring_accessories'])->name('admin.update_wiring_accessories');

            Route::get('update_wiring_accessories_status/{id}/{status}', [WiringAccessoriesController::class, 'update_wiring_accessories_status'])->name('admin.update_wiring_accessories_status');
            Route::get('delete_wiring_accessories/{id}', [WiringAccessoriesController::class, 'delete_wiring_accessories'])->name('admin.delete_wiring_accessories');
            //*

            //* Wiring Accessories Stock 
            Route::get('manage_wiring_stock', [WiringAccessoriesController::class, 'manage_wiring_stock'])->name('admin.manage_wiring_stock');
            Route::get('getWirings', [WiringAccessoriesController::class, 'getWirings'])->name('admin.getWirings');
            Route::post('insert_wiring_stock', [WiringAccessoriesController::class, 'insert_wiring_stock'])->name('admin.insert_wiring_stock');

            Route::get('edit_wiring_stock/{id}', [WiringAccessoriesController::class, 'edit_wiring_stock'])->name('admin.edit_wiring_stock');
            Route::post('update_wiring_stock', [WiringAccessoriesController::class, 'update_wiring_stock'])->name('admin.update_wiring_stock');

            Route::get('update_wiring_stock_status/{id}/{status}', [WiringAccessoriesController::class, 'update_wiring_stock_status'])->name('admin.update_wiring_stock_status');
            Route::get('delete_wiring_stock/{id}', [WiringAccessoriesController::class, 'delete_wiring_stock'])->name('admin.delete_wiring_stock');
            //*


            //* Panel
            Route::get('manage_panel', [PanelController::class, 'manage_panel'])->name('admin.manage_panel');
            Route::post('insert_panel', [PanelController::class, 'insert_panel'])->name('admin.insert_panel');

            Route::get('edit_panel/{id}', [PanelController::class, 'edit_panel'])->name('admin.edit_panel');
            Route::post('update_panel', [PanelController::class, 'update_panel'])->name('admin.update_panel');

            Route::get('update_panel_status/{id}/{status}', [PanelController::class, 'update_panel_status'])->name('admin.update_panel_status');
            Route::get('delete_panel/{id}', [PanelController::class, 'delete_panel'])->name('admin.delete_panel');
            //*

            //* References
            Route::get('manage_reference', [ReferenceController::class, 'manage_reference'])->name('admin.manage_reference');
            Route::post('insert_reference', [ReferenceController::class, 'insert_reference'])->name('admin.insert_reference');

            Route::get('edit_reference/{id}', [ReferenceController::class, 'edit_reference'])->name('admin.edit_reference');
            Route::post('update_reference', [ReferenceController::class, 'update_reference'])->name('admin.update_reference');

            Route::get('update_reference_status/{id}/{status}', [ReferenceController::class, 'update_reference_status'])->name('admin.update_reference_status');
            Route::get('delete_reference/{id}', [ReferenceController::class, 'delete_reference'])->name('admin.delete_reference');

            Route::get('getCity', [ReferenceController::class, 'getCity'])->name('admin.getCity');

            //*

            //* dealer_city
            Route::get('manage_dealer_city', [DealerCityController::class, 'manage_dealer_city'])->name('admin.manage_dealer_city');
            Route::post('insert_dealer_city', [DealerCityController::class, 'insert_dealer_city'])->name('admin.insert_dealer_city');

            Route::get('edit_dealer_city/{id}', [DealerCityController::class, 'edit_dealer_city'])->name('admin.edit_dealer_city');
            Route::post('update_dealer_city', [DealerCityController::class, 'update_dealer_city'])->name('admin.update_dealer_city');

            Route::get('update_dealer_city_status/{id}/{status}', [DealerCityController::class, 'update_dealer_city_status'])->name('admin.update_dealer_city_status');
            Route::get('delete_dealer_city/{id}', [DealerCityController::class, 'delete_dealer_city'])->name('admin.delete_dealer_city');
            //*

            //* Panel Stock 
            Route::get('manage_panel_stock', [PanelController::class, 'manage_panel_stock'])->name('admin.manage_panel_stock');
            Route::get('getPanels', [PanelController::class, 'getPanels'])->name('admin.getPanels');
            Route::post('insert_panel_stock', [PanelController::class, 'insert_panel_stock'])->name('admin.insert_panel_stock');

            Route::get('edit_panel_stock/{id}', [PanelController::class, 'edit_panel_stock'])->name('admin.edit_panel_stock');
            Route::post('update_panel_stock', [PanelController::class, 'update_panel_stock'])->name('admin.update_panel_stock');

            Route::get('update_panel_stock_status/{id}/{status}', [PanelController::class, 'update_panel_stock_status'])->name('admin.update_panel_stock_status');
            Route::get('delete_panel_stock/{id}', [PanelController::class, 'delete_panel_stock'])->name('admin.delete_panel_stock');
            //*

            //* Inverter
            Route::get('manage_inverter', [InverterController::class, 'manage_inverter'])->name('admin.manage_inverter');
            Route::post('insert_inverter', [InverterController::class, 'insert_inverter'])->name('admin.insert_inverter');

            Route::get('edit_inverter/{id}', [InverterController::class, 'edit_inverter'])->name('admin.edit_inverter');
            Route::post('update_inverter', [InverterController::class, 'update_inverter'])->name('admin.update_inverter');

            Route::get('update_inverter_status/{id}/{status}', [InverterController::class, 'update_inverter_status'])->name('admin.update_inverter_status');
            Route::get('delete_inverter/{id}', [InverterController::class, 'delete_inverter'])->name('admin.delete_inverter');
            //*

            //* Inverter Stock 
            Route::get('manage_inverter_stock', [InverterController::class, 'manage_inverter_stock'])->name('admin.manage_inverter_stock');
            Route::get('getInverters', [InverterController::class, 'getInverters'])->name('admin.getInverters');
            Route::post('insert_inverter_stock', [InverterController::class, 'insert_inverter_stock'])->name('admin.insert_inverter_stock');

            Route::get('edit_inverter_stock/{id}', [InverterController::class, 'edit_inverter_stock'])->name('admin.edit_inverter_stock');
            Route::post('update_inverter_stock', [InverterController::class, 'update_inverter_stock'])->name('admin.update_inverter_stock');

            Route::get('update_inverter_stock_status/{id}/{status}', [InverterController::class, 'update_inverter_stock_status'])->name('admin.update_inverter_stock_status');
            Route::get('delete_inverter_stock/{id}', [InverterController::class, 'delete_inverter_stock'])->name('admin.delete_inverter_stock');
            //*

            //* Cable
            Route::get('manage_cable', [CableController::class, 'manage_cable'])->name('admin.manage_cable');
            Route::post('insert_cable', [CableController::class, 'insert_cable'])->name('admin.insert_cable');

            Route::get('edit_cable/{id}', [CableController::class, 'edit_cable'])->name('admin.edit_cable');
            Route::post('update_cable', [CableController::class, 'update_cable'])->name('admin.update_cable');

            Route::get('update_cable_status/{id}/{status}', [CableController::class, 'update_cable_status'])->name('admin.update_cable_status');
            Route::get('delete_cable/{id}', [CableController::class, 'delete_cable'])->name('admin.delete_cable');
            //*

            //* Cable Stock 
            Route::get('manage_cable_stock', [CableController::class, 'manage_cable_stock'])->name('admin.manage_cable_stock');
            Route::get('getCables', [CableController::class, 'getCables'])->name('admin.getCables');
            Route::post('insert_cable_stock', [CableController::class, 'insert_cable_stock'])->name('admin.insert_cable_stock');

            Route::get('edit_cable_stock/{id}', [CableController::class, 'edit_cable_stock'])->name('admin.edit_cable_stock');
            Route::post('update_cable_stock', [CableController::class, 'update_cable_stock'])->name('admin.update_cable_stock');

            Route::get('update_cable_stock_status/{id}/{status}', [CableController::class, 'update_cable_stock_status'])->name('admin.update_cable_stock_status');
            Route::get('delete_cable_stock/{id}', [CableController::class, 'delete_cable_stock'])->name('admin.delete_cable_stock');
            //*


            //* Stock
            // Route::get('manage_stock', [AdminController::class, 'manage_stock'])->name('admin.manage_stock');
            // Route::get('view_stock', [AdminController::class, 'view_stock'])->name('admin.view_stock');
            //*

            // *Client
            Route::get('manage_client', [ClientController::class, 'manage_client'])->name('admin.manage_client');
            Route::get('add_client_details', [ClientController::class, 'add_client'])->name('admin.add_client');
            Route::post('insert_client', [ClientController::class, 'insert_client'])->name('admin.insert_client');
            Route::get('manage_client', [ClientController::class, 'manage_client'])->name('admin.manage_client');
            Route::get('edit_client/{id}', [ClientController::class, 'edit_client'])->name('admin.edit_client');
            Route::post('update_client', [ClientController::class, 'update_client'])->name('admin.update_client');

            Route::get('update_client_status/{id}/{status}', [ClientController::class, 'update_client_status'])->name('admin.update_client_status');
            Route::get('update_client_permision/{id}/{permision}', [ClientController::class, 'update_client_permision'])->name('admin.update_client_permision');
            Route::get('delete_client/{id}', [ClientController::class, 'delete_client'])->name('admin.delete_client');

            // *Client Tracking
            Route::get('add_client_tracking', [ClientController::class, 'add_client_tracking'])->name('admin.add_client_tracking');
            Route::post('insert_client_tracking', [ClientController::class, 'insert_client_tracking'])->name('admin.insert_client_tracking');

            Route::post('update_client_tracking', [ClientController::class, 'update_client_tracking'])->name('admin.update_client_tracking');

            // *Client Document
            Route::get('client_details/{consumer_number}', [ClientController::class, 'client_details'])->name('admin.client_details');
            Route::get('manage_client_document', [ClientController::class, 'manage_client_document'])->name('admin.manage_client_document');
            Route::get('add_client_document', [ClientController::class, 'add_client_document'])->name('admin.add_client_document');
            Route::post('insert_client_document', [ClientController::class, 'insert_client_document'])->name('admin.insert_client_document');
            Route::get('edit_client_document/{consumer_number}', [ClientController::class, 'edit_client_document'])->name('admin.edit_client_document');
            Route::post('update_client_document', [ClientController::class, 'update_client_document'])->name('admin.update_client_document');

            // *Payment
            Route::get('manage_payment_dashboard', [PaymentController::class, 'manage_payment_dashboard'])->name('admin.manage_payment_dashboard');
            Route::get('manage_payment', [PaymentController::class, 'manage_payment'])->name('admin.manage_payment');
            Route::get('add_payment', [PaymentController::class, 'add_payment'])->name('admin.add_payment');
            Route::post('insert_client_payment', [PaymentController::class, 'insert_client_payment'])->name('admin.insert_client_payment');
            Route::get('edit_client_payment/{id}', [PaymentController::class, 'edit_client_payment'])->name('admin.edit_client_payment');
            Route::post('update_client_payment', [PaymentController::class, 'update_client_payment'])->name('admin.update_client_payment');


            Route::get('download_document_and_update', [ClientController::class, 'download_document_and_update'])->name('admin.download_document_and_update');
            
            // *terms & conditions
            Route::get('/terms-and-conditions', [TermsConditionController::class, 'edit'])->name('admin.terms.edit');
            Route::post('/terms-and-conditions', [TermsConditionController::class, 'update'])->name('admin.terms.update');

            // Route::get('edit/terms-conditions', [AdminController::class, 'editPageContent'])->name('admin.terms-&-conditions');
            // Route::post('save-page-content', [AdminController::class, 'savePageContent'])->name('admin.save.pageContent');



            //* branch_location
            Route::get('manage_branch_location', [BranchLocationController::class, 'manage_branch_location'])->name('admin.manage_branch_location');
            Route::post('insert_branch_location', [BranchLocationController::class, 'insert_branch_location'])->name('admin.insert_branch_location');

            Route::get('edit_branch_location/{id}', [BranchLocationController::class, 'edit_branch_location'])->name('admin.edit_branch_location');
            Route::post('update_branch_location', [BranchLocationController::class, 'update_branch_location'])->name('admin.update_branch_location');

            Route::get('update_branch_location_status/{id}/{status}', [BranchLocationController::class, 'update_branch_location_status'])->name('admin.update_branch_location_status');
            Route::get('delete_branch_location/{id}', [BranchLocationController::class, 'delete_branch_location'])->name('admin.delete_branch_location');
            //*

        });
    });

    Route::prefix('employee')->group(function () {
        Route::middleware(['EmployeeAuth'])->group(function () {
            Route::get('dashboard', [EmployeeController::class, 'dashboard'])->name('employee.dashboard');
            // Route::get('add_client_details', [ClientController::class, 'add_client'])->name('employee.add_client');
            // Route::get('manage_client', [ClientController::class, 'manage_client'])->name('employee.manage_client');
            // Route::get('add_client_document', [ClientController::class, 'add_client_document'])->name('employee.add_client_document');
            // Route::get('client_details', [ClientController::class, 'client_details'])->name('employee.client_details');

            // *Client
            Route::get('manage_client', [EmployeeClientController::class, 'manage_client'])->name('employee.manage_client');
            Route::get('add_client_details', [EmployeeClientController::class, 'add_client'])->name('employee.add_client');
            Route::post('insert_client', [EmployeeClientController::class, 'insert_client'])->name('employee.insert_client');
            Route::get('manage_client', [EmployeeClientController::class, 'manage_client'])->name('employee.manage_client');
            Route::get('edit_client/{id}', [EmployeeClientController::class, 'edit_client'])->name('employee.edit_client');
            Route::post('update_client', [EmployeeClientController::class, 'update_client'])->name('employee.update_client');

            Route::get('update_client_status/{id}/{status}', [EmployeeClientController::class, 'update_client_status'])->name('employee.update_client_status');
            Route::get('update_client_permision/{id}/{permision}', [EmployeeClientController::class, 'update_client_permision'])->name('employee.update_client_permision');
            Route::get('delete_client/{id}', [EmployeeClientController::class, 'delete_client'])->name('employee.delete_client');

            // *Client Tracking
            Route::get('add_client_tracking', [EmployeeClientController::class, 'add_client_tracking'])->name('employee.add_client_tracking');
            Route::post('insert_client_tracking', [EmployeeClientController::class, 'insert_client_tracking'])->name('employee.insert_client_tracking');

            Route::post('update_client_tracking', [EmployeeClientController::class, 'update_client_tracking'])->name('employee.update_client_tracking');

            // *Client Document
            Route::get('client_details/{consumer_number}', [EmployeeClientController::class, 'client_details'])->name('employee.client_details');
            Route::get('manage_client_document', [EmployeeClientController::class, 'manage_client_document'])->name('employee.manage_client_document');
            Route::get('add_client_document', [EmployeeClientController::class, 'add_client_document'])->name('employee.add_client_document');
            Route::post('insert_client_document', [EmployeeClientController::class, 'insert_client_document'])->name('employee.insert_client_document');
            Route::get('edit_client_document/{consumer_number}', [EmployeeClientController::class, 'edit_client_document'])->name('employee.edit_client_document');
            Route::post('update_client_document', [EmployeeClientController::class, 'update_client_document'])->name('employee.update_client_document');

            // *Payment
            Route::get('manage_payment', [EmployeePaymentController::class, 'manage_payment'])->name('employee.manage_payment');
            Route::get('add_payment', [EmployeePaymentController::class, 'add_payment'])->name('employee.add_payment');
            Route::post('insert_client_payment', [EmployeePaymentController::class, 'insert_client_payment'])->name('employee.insert_client_payment');
            Route::get('edit_client_payment/{id}', [EmployeePaymentController::class, 'edit_client_payment'])->name('employee.edit_client_payment');
            Route::post('update_client_payment', [EmployeePaymentController::class, 'update_client_payment'])->name('employee.update_client_payment');

            Route::get('download_document_and_update', [EmployeeClientController::class, 'download_document_and_update'])->name('employee.download_document_and_update');

            // *Stock Management
            Route::get('employee_add_material', [SellProductController::class, 'employee_add_material'])->name('employee.employee_add_material');
            Route::get('employee_material_report', [StockController::class, 'employee_material_report'])->name('employee.employee_material_report');
            Route::get('employee_manage_stock', [StockController::class, 'employee_manage_stock'])->name('employee.employee_manage_stock');
            Route::get('employee_manage_purchase_producs', [PurchaseProducController::class, 'employee_manage_purchase_producs'])->name('employee.employee_manage_purchase_producs');


        });
    });

    Route::prefix('dealer')->group(function () {
        Route::middleware(['DealerAuth'])->group(function () {
            Route::get('dashboard', [DealerController::class, 'dashboard'])->name('dealer.dashboard');
            // Route::get('add_client_details', [ClientController::class, 'add_client'])->name('dealer.add_client');
            // Route::get('manage_client', [ClientController::class, 'manage_client'])->name('dealer.manage_client');
            // Route::get('add_client_document', [ClientController::class, 'add_client_document'])->name('dealer.add_client_document');
            // Route::get('client_details', [ClientController::class, 'client_details'])->name('dealer.client_details');

            // *Client
            Route::get('manage_client', [DealerClientController::class, 'manage_client'])->name('dealer.manage_client');
            Route::get('add_client_details', [DealerClientController::class, 'add_client'])->name('dealer.add_client');
            Route::post('insert_client', [DealerClientController::class, 'insert_client'])->name('dealer.insert_client');
            Route::get('manage_client', [DealerClientController::class, 'manage_client'])->name('dealer.manage_client');
            Route::get('edit_client/{id}', [DealerClientController::class, 'edit_client'])->name('dealer.edit_client');
            Route::post('update_client', [DealerClientController::class, 'update_client'])->name('dealer.update_client');

            Route::get('update_client_status/{id}/{status}', [DealerClientController::class, 'update_client_status'])->name('dealer.update_client_status');
            Route::get('update_client_permision/{id}/{permision}', [DealerClientController::class, 'update_client_permision'])->name('dealer.update_client_permision');
            Route::get('delete_client/{id}', [DealerClientController::class, 'delete_client'])->name('dealer.delete_client');

            // *Client Tracking
            Route::get('add_client_tracking', [DealerClientController::class, 'add_client_tracking'])->name('dealer.add_client_tracking');
            Route::post('insert_client_tracking', [DealerClientController::class, 'insert_client_tracking'])->name('dealer.insert_client_tracking');

            Route::post('update_client_tracking', [DealerClientController::class, 'update_client_tracking'])->name('dealer.update_client_tracking');

            // *Client Document
            Route::get('client_details/{consumer_number}', [DealerClientController::class, 'client_details'])->name('dealer.client_details');
            Route::get('manage_client_document', [DealerClientController::class, 'manage_client_document'])->name('dealer.manage_client_document');
            Route::get('add_client_document', [DealerClientController::class, 'add_client_document'])->name('dealer.add_client_document');
            Route::post('insert_client_document', [DealerClientController::class, 'insert_client_document'])->name('dealer.insert_client_document');
            Route::get('edit_client_document/{consumer_number}', [DealerClientController::class, 'edit_client_document'])->name('dealer.edit_client_document');
            Route::post('update_client_document', [DealerClientController::class, 'update_client_document'])->name('dealer.update_client_document');

            // *Payment
            Route::get('manage_payment', [DealerPaymentController::class, 'manage_payment'])->name('dealer.manage_payment');
            Route::get('add_payment', [DealerPaymentController::class, 'add_payment'])->name('dealer.add_payment');
            Route::post('insert_client_payment', [DealerPaymentController::class, 'insert_client_payment'])->name('dealer.insert_client_payment');
            Route::get('edit_client_payment/{id}', [DealerPaymentController::class, 'edit_client_payment'])->name('dealer.edit_client_payment');
            Route::post('update_client_payment', [DealerPaymentController::class, 'update_client_payment'])->name('dealer.update_client_payment');

            Route::get('download_document_and_update', [DealerClientController::class, 'download_document_and_update'])->name('dealer.download_document_and_update');

            // *Stock Management
            Route::get('dealer_add_material', [SellProductController::class, 'dealer_add_material'])->name('dealer.dealer_add_material');
            Route::get('dealer_material_report', [StockController::class, 'dealer_material_report'])->name('dealer.dealer_material_report');

            // *Stock Management
            // Route::get('employee_add_material', [SellProductController::class, 'employee_add_material'])->name('employee.employee_add_material');
            // Route::get('employee_manage_stock', [StockController::class, 'employee_manage_stock'])->name('employee.employee_manage_stock');
            // Route::get('employee_manage_purchase_producs', [PurchaseProducController::class, 'employee_manage_purchase_producs'])->name('employee.employee_manage_purchase_producs');

        });
    });

    Route::prefix('installer')->group(function () {
        Route::middleware(['InstallerAuth'])->group(function () {
            Route::get('installer_dashboard', [InstallerController::class, 'installer_dashboard'])->name('installer.dashboard');
            Route::get('installer.manage_sell_product', [InstallerController::class, 'manage_sell_product'])->name('installer.manage_sell_product');
            Route::get('client_stock_details/{consumer_number}', [InstallerController::class, 'client_stock_details'])->name('installer.client_stock_details');
            Route::get('add_material', [InstallerController::class, 'add_material'])->name('installer.add_material');
            Route::post('insert_material', [ClientMaterialController::class, 'insert_material'])->name('installer.insert_material');
            // Route::get('material_report', [ClientMaterialController::class, 'material_report'])->name('installer.material_report');
            Route::get('add_completion_images', [ClientMaterialController::class, 'add_completion_images'])->name('installer.add_completion_images');



            // *Stock Management
            Route::get('installer_add_material', [SellProductController::class, 'installer_add_material'])->name('installer.installer_add_material');
            Route::get('installer_material_report', [StockController::class, 'installer_material_report'])->name('installer.installer_material_report');
            Route::get('installer_manage_stock', [StockController::class, 'installer_manage_stock'])->name('installer.installer_manage_stock');
            Route::get('installer_manage_purchase_producs', [PurchaseProducController::class, 'installer_manage_purchase_producs'])->name('installer.installer_manage_purchase_producs');
        });
    });
});
