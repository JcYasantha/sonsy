<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'id','Fname', 'Outstanding','CustomerID','newInvoiceNo','InvoiceNo','itemname','quantity','line_total','InvoiceNo','Items','Outstanding','id'
    ];
}
