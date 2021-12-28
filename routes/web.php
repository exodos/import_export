<?php

use App\Exports\SiteExport;
use App\Http\Controllers\AirConditionerController;
use App\Http\Controllers\AirConditionersExportController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\BatteriesExportController;
use App\Http\Controllers\BatteryController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\ClientBoardsExportController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FiberLinkController;
use App\Http\Controllers\FiberSplicePointController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IpAddressController;
use App\Http\Controllers\IpAddressExportController;
use App\Http\Controllers\MicrowaveController;
use App\Http\Controllers\PortController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\PowersExportController;
use App\Http\Controllers\RectifierController;
use App\Http\Controllers\RectifiersExportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SitesExportController;
use App\Http\Controllers\SolarPanelController;
use App\Http\Controllers\SolarPanelsExportController;
use App\Http\Controllers\TowerController;
use App\Http\Controllers\TowersExportController;
use App\Http\Controllers\TransmissionAmplifierBoardController;
use App\Http\Controllers\TransmissionAmplifiersExportController;
use App\Http\Controllers\TransmissionClientBoardController;
use App\Http\Controllers\TransmissionEquipmentController;
use App\Http\Controllers\TransmissionLineBoardController;
use App\Http\Controllers\TransmissionLineBoardWdmTrailController;
use App\Http\Controllers\TransmissionMuxDemuxBoardController;
use App\Http\Controllers\TransmissionOtnNeController;
use App\Http\Controllers\TransmissionOtnServiceController;
use App\Http\Controllers\TransmissionRoadmBoardController;
use App\Http\Controllers\TransmissionSiteController;
use App\Http\Controllers\TransmissionSiteLineFiberController;
use App\Http\Controllers\UpsController;
use App\Http\Controllers\UpsExportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\WorkOrdersExportController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['register' => false]);

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/searches/search', [SearchController::class, 'search'])->name('search');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
//    Route::get('/sites/search', [SiteController::class, 'search'])->name('sites.search');
//    Route::get('/sites/export', [SitesExportController::class, 'export'])->name('sites.export');
//    Route::resource('sites', SiteController::class);
    Route::get('audits', [AuditController::class, 'index'])->name('audits');
    Route::get('change-password', [ChangePasswordController::class, 'index']);
    Route::post('change-password', [ChangePasswordController::class, 'store'])->name('change.password');
    Route::resource('customers', CustomerController::class);
    Route::resource('groups', GroupController::class);
    Route::resource('vendors', VendorController::class);
});
