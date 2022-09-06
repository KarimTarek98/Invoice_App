<?php

use App\Http\Controllers\InvoiceReports;
use Illuminate\Support\Facades\Route;

Route::prefix("reports")->group(function(){
    Route::get("/invoices", [InvoiceReports::class, "index"]);
    Route::get('/search_invoices', [InvoiceReports::class, 'searchInvoices']);
    Route::get('/customer_invoices', [InvoiceReports::class, 'customerIndex']);
    Route::get('/customer_search', [InvoiceReports::class, 'customerSearch']);
});

