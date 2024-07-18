<?php

// InvoiceController.php
namespace App\Http\Controllers;

use App\Models\InvoiceHeader;

class InvoiceController extends Controller
{
    public function show(InvoiceHeader $invoice)
    {
        $invoice->load('details.toy');
        return view('invoice.show', compact('invoice'));
    }
}
