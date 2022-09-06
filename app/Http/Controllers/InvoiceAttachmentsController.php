<?php

namespace App\Http\Controllers;

use App\Models\InvoiceAttachments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceAttachmentsController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $request->validate([
            'file_name' => 'mimes:pdf,jpeg,jpg,png'
        ],[
            'file_name.mimes' => 'Unsupported file format'
        ]);

        $image = $request->file('file_name');

        $fileName = $image->getClientOriginalName();

        $attachments = new InvoiceAttachments();

        $attachments->file_name = $fileName;
        $attachments->invoice_number = $request->invoice_number;
        $attachments->created_by = Auth::user()->name;
        $attachments->invoice_id = $request->invoice_id;

        $attachments->save();

        // move pic

        $imageName = $request->file_name->getClientOriginalName();

        $request->file_name->move(public_path('Attachments/'. $request->invoice_number), $imageName);

        session()->flash('Add', 'Attachment Added');

        return redirect()->back();
    }


    public function show(InvoiceAttachments $invoiceAttachments)
    {
        //
    }


    public function edit(InvoiceAttachments $invoiceAttachments)
    {
        //
    }


    public function update(Request $request, InvoiceAttachments $invoiceAttachments)
    {
        //
    }

    
    public function destroy(InvoiceAttachments $invoiceAttachments)
    {
        //
    }
}
