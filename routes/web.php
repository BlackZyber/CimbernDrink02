<?php

use App\Http\Controllers\UserController;
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

Route::get('/', function (){
    return view('dashboard', ['drinks' => auth()->user()->drinks()->orderBy('drink_user.created_at', 'desc')->get()]);
})->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard', ['drinks' => auth()->user()->drinks()->orderBy('drink_user.created_at', 'desc')->get()]);
})->middleware(['auth'])->name('dashboard');

Route::get('/konsum', function () {
    return view('konsum');
})->middleware(['auth'])->name('konsum');

Route::get('/admin/register', function () {
    return view('admin.adminRegister');
})->middleware(['admin'])->name('adminRegister');

Route::get('/admin/user', function () {
    return view('admin.adminUser', ['users' => \App\Models\User::all()]);
})->middleware(['admin'])->name('adminUser');

Route::get('/admin/user/{user}/edit', function (\App\Models\User $user) {
    return view('admin.adminUserEdit', ['user' => $user]);
})->middleware(['admin'])->name('adminUserEdit');

Route::get('/admin/log', function () {
    return view('admin.adminLog', ['users' => \App\Models\User::with('drinks')->get()]);
})->middleware(['admin'])->name('adminLog');

Route::get('/admin/invoice', function () {
    return view('admin.adminInvoice', ['invoices' => \App\Models\Invoice::all()]);
})->middleware(['admin'])->name('adminInvoice');

Route::get('/admin/drinks', function () {
    return view('admin.adminDrinks', ['drinks' => \App\Models\Drink::all()]);
})->middleware(['admin'])->name('adminDrinks');

Route::get('/admin/drinks/{drink}/edit', function (\App\Models\Drink $drink) {
    return view('admin.adminDrinkEdit', ['drink' => $drink]);
})->middleware(['admin'])->name('adminDrinkEdit');



Route::get('presssystem', function (){
   return view('input', ['users' => \App\Models\User::orderBy('amount', 'desc')->get()]);
});

Route::get('presssystem/user', function (){
    return view('input_user',['drinks' => auth()->user()->drinks()->orderBy('drink_user.created_at', 'desc')->get()]);
})->middleware(['auth']);

Route::put('/admin/drinks/{drink}', [\App\Http\Controllers\Admin\AdminController::class, 'updateDrinks'])->middleware(['admin']);
Route::put('/admin/user/{drink}', [\App\Http\Controllers\Admin\AdminController::class, 'updateUser'])->middleware(['admin']);


Route::post('presssystem/user', [\App\Http\Controllers\UserController::class, 'barcodeLogin']);
Route::post('drinks', [\App\Http\Controllers\UserController::class, 'saveDrink']);
Route::post('deleteUser', [\App\Http\Controllers\Admin\AdminController::class, 'deleteUser']);
Route::post('changePassword', [\App\Http\Controllers\Admin\AdminController::class, 'changePassword']);
Route::post('admin/export', [\App\Http\Controllers\Admin\AdminController::class, 'export']);
Route::post('admin/invoice', [\App\Http\Controllers\Admin\AdminController::class, 'downloadExport']);




require __DIR__.'/auth.php';
