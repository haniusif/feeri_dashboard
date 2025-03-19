<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use  App\Http\Controllers\FEERI\BankController;
use  App\Http\Controllers\FEERI\CityController;
use  App\Http\Controllers\FEERI\CountryController;
use  App\Http\Controllers\FEERI\Customer_addressController;
use  App\Http\Controllers\FEERI\Driver_bank_accountController;
use  App\Http\Controllers\FEERI\Driver_contract_typeController;
use  App\Http\Controllers\FEERI\Driver_shipmentController;
use  App\Http\Controllers\FEERI\DriverController;
use  App\Http\Controllers\FEERI\Id_typeController;
use  App\Http\Controllers\FEERI\Model_has_permissionController;
use  App\Http\Controllers\FEERI\Model_has_roleController;
use  App\Http\Controllers\FEERI\NationalityController;
use  App\Http\Controllers\FEERI\NeighbourhoodController;
use  App\Http\Controllers\FEERI\Order_activityController;
use  App\Http\Controllers\FEERI\Order_messageController;
use  App\Http\Controllers\FEERI\Order_packageController;
use  App\Http\Controllers\FEERI\Order_statusController;
use  App\Http\Controllers\FEERI\OrderController;
use  App\Http\Controllers\FEERI\PermissionController;
use  App\Http\Controllers\FEERI\Plate_registration_typeController;
use  App\Http\Controllers\FEERI\Project_statusController;
use  App\Http\Controllers\FEERI\ProjectController;
use  App\Http\Controllers\FEERI\Role_has_permissionController;
use  App\Http\Controllers\FEERI\RoleController;
use  App\Http\Controllers\FEERI\UserController;
use  App\Http\Controllers\FEERI\Vehicle_colorController;
use  App\Http\Controllers\FEERI\Vehicle_handoverController;
use  App\Http\Controllers\FEERI\Vehicle_manufacturerController;
use  App\Http\Controllers\FEERI\Vehicle_modelController;
use  App\Http\Controllers\FEERI\Vehicle_statusController;
use  App\Http\Controllers\FEERI\Vehicle_supplierController;
use  App\Http\Controllers\FEERI\Vehicle_typeController;
use  App\Http\Controllers\FEERI\VehicleController;
use  App\Http\Controllers\HomeController;


      Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',
                  ])->group(function () {

      Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');
      Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
      Route::get('/lang/{locale}', [HomeController::class, 'swap']);
        Route::resource('banks', BankController::class);
        Route::resource('cities', CityController::class);
        Route::resource('countries', CountryController::class);
        Route::resource('customer_addresses', Customer_addressController::class);
        Route::resource('driver_bank_accounts', Driver_bank_accountController::class);
        Route::resource('driver_contract_types', Driver_contract_typeController::class);
        Route::resource('driver_shipments', Driver_shipmentController::class);
        Route::resource('drivers', DriverController::class);
        Route::resource('id_types', Id_typeController::class);
        Route::resource('model_has_permissions', Model_has_permissionController::class);
        Route::resource('model_has_roles', Model_has_roleController::class);
        Route::resource('nationalities', NationalityController::class);
        Route::resource('neighbourhoods', NeighbourhoodController::class);
        Route::resource('order_activities', Order_activityController::class);
        Route::resource('order_messages', Order_messageController::class);
        Route::resource('order_packages', Order_packageController::class);
        Route::resource('order_statuses', Order_statusController::class);
        Route::resource('orders', OrderController::class);
        Route::resource('permissions', PermissionController::class);
        Route::resource('plate_registration_types', Plate_registration_typeController::class);
        Route::resource('project_statuses', Project_statusController::class);
        Route::resource('projects', ProjectController::class);
        Route::resource('role_has_permissions', Role_has_permissionController::class);
        Route::resource('roles', RoleController::class);
        Route::resource('users', UserController::class);
        Route::resource('vehicle_colors', Vehicle_colorController::class);
        Route::resource('vehicle_handovers', Vehicle_handoverController::class);
        Route::resource('vehicle_manufacturers', Vehicle_manufacturerController::class);
        Route::resource('vehicle_models', Vehicle_modelController::class);
        Route::resource('vehicle_statuses', Vehicle_statusController::class);
        Route::resource('vehicle_suppliers', Vehicle_supplierController::class);
        Route::resource('vehicle_types', Vehicle_typeController::class);
        Route::resource('vehicles', VehicleController::class);


                });
