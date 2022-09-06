<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceAttachments;
use App\Models\InvoiceDetails;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Notifications\AddInvoice;
use Illuminate\Support\Facades\Notification;
use App\Exports\InvoiceExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\AddInvoiceDB;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoices = Invoice::get();
        return view('invoices.invoices', compact('invoices'));
    }


    public function create()
    {
        $sections = Section::get();
        return view('invoices.add_invoice', compact('sections'));
    }


    public function store(Request $request)
    {

        Invoice::create([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'section_id' => $request->section,
            'product' => $request->product,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->commission_amount,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vate' => $request->rate_vate,
            'total' => $request->total,
            'status' => 'not paid',
            'value_status' => 2,
            'note' => $request->note,
        ]);

        $invoiceId = Invoice::latest()->first()->id;

        InvoiceDetails::create([
            'invoice_id' => $invoiceId,
            'invoice_number' => $request->invoice_number,
            'product' => $request->product,
            'section' => $request->section,
            'status' => 'not paid',
            'status_value' => 2,
            'note' => $request->note,
            'user' => (Auth::user()->name)
        ]);

        if ($request->hasFile('pic'))
        {
            $this->validate($request, [
                'pic' => 'required|mimes:jpg,jpeg,png,pdf'
            ], [
                'pic.mimes' => 'file type not supported'
            ]);

            $invoiceId = Invoice::latest()->first()->id;

            $image = $request->file('pic');

            $fileName = $image->getClientOriginalName();

            $invoiceNumber = $request->invoice_number;

            InvoiceAttachments::create([
                'file_name' => $fileName,
                'invoice_number' => $invoiceNumber,
                'created_by' => (Auth::user()->name),
                'invoice_id' => $invoiceId
            ]);

            // move pic
            $imageName = $request->pic->getClientOriginalName();

            $request->pic->move(public_path('Attachments/'. $invoiceNumber), $imageName);

        }

        $user = User::first();

        //$user->notify(new AddInvoice($invoiceId));

        // send notification using Notification facade

        // SELECT * FROM users WHERE id != Auth::user()->id OR roles_name = ['owner']
        $allExceptCreate = User::where('id', '!=', Auth::user()->id)
        -> orWhere('roles_name', '=', '["owner"]') ->get();

        $latestInvoiceCreated = Invoice::latest()->first(); // last invoice created

        Notification::send($user, new AddInvoice($invoiceId));

        //Notification::route('mail', Auth::user()->email)->notify;
       // $userCreateInvoice->notify(new AddInvoice($invoice_id));

        Notification::send($allExceptCreate, new AddInvoiceDB($latestInvoiceCreated));


        session()->flash('Add', 'Invoice Added Successfully');
        return back();

    }




    public function show($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        return view('invoices.status_update', compact('invoice'));
    }

    public function updateStatus($id, Request $request)
    {

        $invoice = Invoice::findOrFail($id);

        //return $request->payment_date;

        if ($request->status === 'paid')
        {

            $invoice->update([
                'value_status' => 1,
                'status' => $request->status,
                'payment_date' => $request->payment_date
            ]);

            InvoiceDetails::create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'status' => $request->status,
                'status_value' => 1,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name),
            ]);

        }
        else
        {
            $invoice->update([
                'value_status' => 3,
                'status' => $request->status,
                'payment_date' => $request->payment_date
            ]);

            InvoiceDetails::create([
                'invoice_id' => $request->invoice_id,
                'invoice_number' => $request->invoice_number,
                'product' => $request->product,
                'section' => $request->section,
                'status' => $request->status,
                'status_value' => 3,
                'note' => $request->note,
                'payment_date' => $request->payment_date,
                'user' => (Auth::user()->name),
            ]);
        }

        session()->flash('update_status', 'Payment Status have been updated');
        return redirect()->to('/invoices');

    }

    public function edit($id)
    {
        $invoice = Invoice::where('id', $id)
        ->first();

        $sections = Section::all();

        return view('invoices.edit_invoice', compact('invoice', 'sections'));

    }


    public function update(Request $request)
    {
        $invoiceId = $request->invoice_id;

        $invoice = Invoice::findOrFail($invoiceId);

        $invoice->update([
            'invoice_number' => $request->invoice_number,
            'invoice_date' => $request->invoice_date,
            'due_date' => $request->due_date,
            'product' => $request->product,
            'section_id' => $request->section,
            'amount_collection' => $request->amount_collection,
            'amount_commission' => $request->commission_amount,
            'discount' => $request->discount,
            'value_vat' => $request->value_vat,
            'rate_vate' => $request->rate_vate,
            'total' => $request->total,
            'note' => $request->note,

        ]);

        session()->flash('Edit', 'Invoice have been updated');
        return redirect()->to('/invoices');
    }


    public function destroy(Request $request)
    {
        $id = $request->invoice_id;
        $invoice = Invoice::where('id', $id)->first();
        $attachments = InvoiceAttachments::where('invoice_id', $id)->first();
        $pageID = $request->id_page;

        if ($pageID != 2)
        {
            if (!empty($attachments->invoice_number))
            {
                Storage::disk('public_uploads')->deleteDirectory($attachments->invoice_number);
            }
            $invoice->forceDelete();
            session()->flash('Delete');
            return back();
        }
        else
        {
            $invoice->delete();
            session()->flash('archive');
            return redirect('/Archive');
        }
    }

    public function getProducts($id)
    {
        $products = DB::table('products')->where('section_id', $id)->pluck('product_name', 'id');

        return json_encode($products);
    }

    public function paidInvoices()
    {
        $invoices = Invoice::where('value_status', 1)->get();
        return view('invoices.paidInvoices', compact('invoices'));
    }

    public function unpaidInvoices()
    {
        $invoices = Invoice::where('value_status', 2)->get();
        return view('invoices.unpaidInvoices', compact('invoices'));
    }

    public function partialPaidInvoices()
    {
        $invoices = Invoice::where('value_status', 3)->get();
        return view('invoices.partialPaidInvoices', compact('invoices'));
    }

    public function printInvoice($id)
    {
        $invoice = Invoice::where('id', $id)->first();
        return view('invoices.print', compact('invoice'));
    }

    public function export()
    {
        return Excel::download(new InvoiceExport, 'invoice.xlsx');
    }

    public function markAllAsRead()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        //$url = route('markread');

        if ($unreadNotifications->count() > 0)
        {
            $unreadNotifications->markAsRead();
            return back();
        }
    }

    public function markRead($id)
    {
        $user = User::find(auth()->user()->id);
        if($user)
        {
            $user->unreadNotifications->where('data["id"]', '=' ,$id)->markAsRead();
        }
        return response('good');
    }

}
