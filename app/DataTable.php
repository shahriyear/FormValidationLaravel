<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DataTable extends Model
{
    protected $fillable = [
        'name','email','username','password',
    ];
}
