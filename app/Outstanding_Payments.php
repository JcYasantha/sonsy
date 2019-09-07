<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Outstanding_Payments extends Model
{
    protected $fillable = [
        'id','InvoiceValue','newInvoiceNo','InvoiceNo','Balance'
    ];
}
