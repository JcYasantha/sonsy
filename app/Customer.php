<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'Fname' ,
        'Lname' ,
        'No',
        'City' ,
        'Street',
        'email',
        'NicNo'
    ];
}
