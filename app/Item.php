<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'itemname','quantity','line_total','InvoiceNo','Items'
    ];
}
