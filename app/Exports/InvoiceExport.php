<?php

namespace App\Exports;

use App\Models\Invoice;
use Maatwebsite\Excel\Concerns\FromCollection;

class InvoiceExport implements FromCollection
{

    public function collection()
    {
        return Invoice::select('invoice_number', 'due_date', 'product', 'total', 'status')->get();
    }
}
