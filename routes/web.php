<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\InvoiceArchive;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceDetailsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')
->middleware('activated');

Route::resource('invoices', InvoiceController::class);

Route::resource('sections', SectionController::class);

Route::resource('products', ProductController::class);

Route::get('/section/{id}', [InvoiceController::class, 'getProducts']);

Route::get('/InvoiceDetails/{id}', [InvoiceDetailsController::class, 'edit']);

Route::resource('InvoiceAttachment', InvoiceAttachmentsController::class);

Route::get('/view_file/{invoice_number}/{file_name}', [InvoiceDetailsController::class, 'openFile']);

Route::get('/status_show/{id}', [InvoiceController::class, 'show'])->name('status_show');

Route::patch('/update_status/{id}', [InvoiceController::class, 'updateStatus'])->name('update_status');

Route::get('/paid', [InvoiceController::class, 'paidInvoices']);
Route::get('/unpaid', [InvoiceController::class, 'unpaidInvoices']);
Route::get('/partially', [InvoiceController::class, 'partialPaidInvoices']);

Route::resource('Archive', InvoiceArchive::class);

Route::get('/print_invoice/{id}', [InvoiceController::class, 'printInvoice']);

Route::get('/download/{{invoice_number}}/{{file_name}}', [InvoiceDetailsController::class, 'getFile']);

Route::get('/invoice_export', [InvoiceController::class, 'export']);
Route::get('/markread', [InvoiceController::class, 'markAllAsRead']);

Route::get('/readnotif/{id}', [InvoiceController::class, 'markRead']);

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
});



Route::get('/{page}', [AdminController::class, 'index']);


