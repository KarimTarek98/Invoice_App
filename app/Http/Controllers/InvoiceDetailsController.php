<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetails;
use Illuminate\Http\Request;
use App\Models\InvoiceAttachments;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
class InvoiceDetailsController extends Controller
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
        //
    }


    public function show(InvoiceDetails $invoiceDetails)
    {
        //
    }


    public function edit($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        $invoiceDetails = InvoiceDetails::where('invoice_id', $id)->get();
        $invoiceAttachments = InvoiceAttachments::where('invoice_id', $id)->get();

        return view('invoices.invoices_details', compact('invoice', 'invoiceDetails','invoiceAttachments'));
    }


    public function update(Request $request, InvoiceDetails $invoiceDetails)
    {
        //
    }


    public function destroy(InvoiceDetails $invoiceDetails)
    {
        //
    }

    public function openFile($invoice_number, $file_name)
    {
        $file = Storage::disk('public_uploads')
        ->path($invoice_number. '/' . $file_name);

        return response()->file($file);
    }

    public function getFile($invoice_number, $file_name)
    {
        $file = Storage::disk('public_uploads')->path($invoice_number. '/' . $file_name);
        return Storage::download($file, $file_name);
        //return Storage::download('../../../public/Attachments/'. $invoice_number . '/' . $file_name, $file_name);
    }
}
