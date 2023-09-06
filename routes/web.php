<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PrimaryController;
use App\Http\Controllers\SecondaryController;
use App\Http\Controllers\CronController;

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

Route::get('/', function () {
    return view('/auth/login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home.home');

Route::group(['middleware' => ['auth']], function() {

Route::get('/settingHome', [SettingController::class, 'index'])->name('settingHome');

Route::post('/delete-settings', [SettingController::class, 'deletesetting'])->name('deletesetting');

Route::resource('settings',SettingController::class);

Route::get('/productHome', [ProductController::class, 'index'])->name('productHome');

Route::post('/delete-products', [ProductController::class, 'deleteproduct'])->name('deleteproduct');

Route::resource('products',ProductController::class);
Route::get('/products/view/{id}', [ProductController::class, 'view'])->name('products.view');
Route::get('/get-related-data',[PrimaryController::class, 'getRelatedData']);

Route::get('/primaryHome', [PrimaryController::class, 'index'])->name('primaryHome');

Route::post('/delete-primaries', [PrimaryController::class, 'deleteprimary'])->name('deleteprimary');

Route::resource('primaries',PrimaryController::class);
Route::get('/primaries/view/{id}', [PrimaryController::class, 'view'])->name('primaries.view');

Route::get('/adminindex', [HomeController::class, 'count'])->name('count');

Route::resource('/permissions',PermissionController::class);

Route::resource('/roles',RoleController::class);

Route::post('/roles/{role}/permissions',[RoleController::class, 'givePermission'])->name('roles.permissions');

Route::delete('/roles/{role}/permissions/{permission}',[RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

Route::post('/permissions/{permission}/roles',[PermissionController::class, 'assignRole'])->name('permissions.roles');

Route::delete('/permissions/{permission}/roles/{role}',[PermissionController::class, 'removeRole'])->name('permissions.roles.remove');

Route::post('/delete-permissions', [PermissionController::class, 'deletepermission'])->name('deletepermission');

Route::post('/delete-roles', [RoleController::class, 'deleterole'])->name('deleterole');

Route::get('/adminHome', [AdminController::class, 'index'])->name('adminhome');

Route::post('/delete-users', [AdminController::class, 'deleteUsers'])->name('deleteUsers');

Route::post('/passwordupdate-users/{id}', [AdminController::class, 'passwordupdate'])->name('users.passwordupdate');

Route::resource('users',AdminController::class);

Route::post('/users/{user}/roles',[AdminController::class, 'assignRole'])->name('users.roles');

Route::delete('/users/{user}/roles/{role}',[AdminController::class, 'removeRole'])->name('users.roles.remove');

Route::post('/users/{user}/permissions',[AdminController::class, 'givePermission'])->name('users.permissions');

Route::delete('/users/{user}/permissions/{permission}',[AdminController::class, 'revokePermission'])->name('users.permissions.revoke');
Route::get('/get-srelated-data',[SecondaryController::class, 'getSRelatedData']);
Route::get('/secondaries/index',[SecondaryController::class, 'index'])->name('secondaries.index');
Route::get('/secondaries/create',[SecondaryController::class, 'create'])->name('secondaries.create');
//Added by MMC
Route::get('/cron/getApplications', [CronController::class, 'getApplications'])->name('applications');
Route::get('/cron/getUnitOfMeasurements', [CronController::class, 'getUnitOfMeasurements'])->name('getUnitOfMeasurements');
Route::get('/cron/getCategories', [CronController::class, 'getCategories'])->name('getCategories');

});