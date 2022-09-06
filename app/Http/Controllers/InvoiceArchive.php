<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceArchive extends Controller
{

    public function index()
    {
        $invoices = Invoice::onlyTrashed()->get();
        return view('invoices.archive', compact('invoices'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }



    public function edit($id)
    {
        //
    }


    public function update(Request $request)
    {
        $id = $request->invoice_id;

        Invoice::withTrashed()->where('id', $id)->restore();

        session()->flash('restore_invoice');
        return redirect('/invoices');
    }


    public function destroy(Request $request)
    {
        $id = $request->invoice_id;

        Invoice::withTrashed()->where('id', $id)
        ->first()
        ->forceDelete();

        session()->flash('Delete');
        return redirect('/invoices');
    }
}
