<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postdated_Cheques extends Model
{
    protected $fillable = [
        'chequeNo' ,
        'chequeDate' ,
        'ChequeBalance',
        'Branch' ,
        'Bank',
        'CustomerID'
        
    ];  
}
