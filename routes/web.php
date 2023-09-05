<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PrimaryController;
use App\Models\Welcome;

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

// Route::get('/show-data', function () {
//     $under = Advertisement::where('location','=',1)->first();
//     $under1 = Advertisement::where('location','=',1)->first();
//     return view('above-header1', compact('under'))
//         ->with('aboveHeader2', $under1)
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route::get('/', 'VoterHomeController@index')->name('voter.home');

Route::get('/userindex', [App\Http\Controllers\VoterAuthController::class, 'index'])->name('userindex');

Route::put('/passwordupdate',[App\Http\Controllers\VoterAuthController::class,'passwordupdate']);

Route::group(['middleware' => ['auth']], function() {
// Route::group(['middleware' => ['role:sadmin']] , function () {

Route::get('/sadminindex', [App\Http\Controllers\HomeController::class, 'sadminindex'])->name('sadminindex');

Route::get('/settingHome', [App\Http\Controllers\SettingController::class, 'index'])->name('settingHome');

Route::post('/delete-settings', [SettingController::class, 'deletesetting'])->name('deletesetting');

Route::resource('settings',SettingController::class);

Route::get('/productHome', [App\Http\Controllers\ProductController::class, 'index'])->name('productHome');

Route::post('/delete-products', [ProductController::class, 'deleteproduct'])->name('deleteproduct');

Route::resource('products',ProductController::class);

Route::get('/get-related-data',[App\Http\Controllers\PrimaryController::class, 'getRelatedData']);

Route::get('/primaryHome', [App\Http\Controllers\PrimaryController::class, 'index'])->name('primaryHome');

Route::post('/delete-primaries', [PrimaryController::class, 'deleteprimary'])->name('deleteprimary');

Route::resource('primaries',PrimaryController::class);

Route::get('/adminindex', [App\Http\Controllers\HomeController::class, 'count'])->name('count');

Route::resource('/permissions',PermissionController::class);

Route::resource('/roles',RoleController::class);

Route::post('/roles/{role}/permissions',[RoleController::class, 'givePermission'])->name('roles.permissions');

Route::delete('/roles/{role}/permissions/{permission}',[RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

Route::post('/permissions/{permission}/roles',[PermissionController::class, 'assignRole'])->name('permissions.roles');

Route::delete('/permissions/{permission}/roles/{role}',[PermissionController::class, 'removeRole'])->name('permissions.roles.remove');

Route::post('/delete-permissions', [PermissionController::class, 'deletepermission'])->name('deletepermission');

Route::post('/delete-roles', [RoleController::class, 'deleterole'])->name('deleterole');

Route::get('/adminHome', [App\Http\Controllers\AdminController::class, 'index'])->name('adminhome');

Route::post('/delete-users', [AdminController::class, 'deleteUsers'])->name('deleteUsers');

Route::post('/passwordupdate-users/{id}', [AdminController::class, 'passwordupdate'])->name('users.passwordupdate');

Route::resource('users',AdminController::class);

Route::post('/users/{user}/roles',[AdminController::class, 'assignRole'])->name('users.roles');

Route::delete('/users/{user}/roles/{role}',[AdminController::class, 'removeRole'])->name('users.roles.remove');

Route::post('/users/{user}/permissions',[AdminController::class, 'givePermission'])->name('users.permissions');

Route::delete('/users/{user}/permissions/{permission}',[AdminController::class, 'revokePermission'])->name('users.permissions.revoke');

});