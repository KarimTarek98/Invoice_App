<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Section;
use Illuminate\Http\Request;

class InvoiceReports extends Controller
{
    public function index()
    {
        return view('reports.invoices-reports');
    }

    public function searchInvoices(Request $request)
    {
        //return $request;

        $radio = $request->radio;

        if ( $radio == 1 )
        {
            // if we search by type

            // if we not specify start date and end date
            if ( $request->type && $request->start_at == '' && $request->end_at == '' )
            {
                $invoices = Invoice::select('*')
                    ->where('status', '=', $request->type)->get();
                $type = $request->type;

                return view('reports.invoices-reports',compact('type'))->withDetails($invoices);
            }
            else
            {
                $startAt = $request->start_at;
                $endAt = $request->end_at;
                $type = $request->type;
                $invoices = Invoice::where('status', '=', $type)
                    ->whereBetween('invoice_date', [$startAt, $endAt])->get();

                return view('reports.invoices-reports', compact('type', 'startAt', 'endAt'))
                        ->withDetails($invoices);
            }
        }
        else // if we search by invoice number
        {
            $invoiceNumber = $request->invoice_number;
            $invoices = Invoice::select('*')->where('invoice_number', '=', $invoiceNumber)->get();

            return view('reports.invoices-reports')->withDetails($invoices);
        }


    }

    public function customerIndex()
    {
        $sections = Section::all();
        return view('reports.customer-reports', compact('sections'));
    }

    public function customerSearch(Request $request)
    {
        $start_at = $request -> start_at;
        $end_at = $request -> end_at;

        $product = $request -> product;
        $sectionId = $request -> section;

        if (isset($product, $sectionId) && $start_at == '' && $end_at == '')
        {
            $invoices = Invoice::select('*') -> where('section_id', '=', $sectionId)
                -> where('product', '=', $product) -> get();


            if ($request -> product == 'all')
            {
                $invoices = Invoice::select('*') -> where('section_id', '=', $sectionId) -> get();
            }
            $sections = Section::all();

            return view('reports.customer-reports', compact('sections'))
                    -> withDetails($invoices);
        }
        /*elseif ($product == 'all' && $start_at == '' && $end_at == '')
        {
            $invoices = Invoice::where('section_id', '=', $sectionId);
            $sections = Section::all();
            return $invoices;

        }*/
        else
        {
            $invoices = Invoice::select('*') -> whereBetween('invoice_date', [$start_at, $end_at])
            -> where('product', '=', $product) -> where('section_id', '=', $sectionId) -> get();

            $sections = Section::all();

            return view('reports.customer-reports', compact('sections'))
                -> withDetails($invoices);
        }
    }
}
