<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class configuration extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'address', 'deposit_address', 'deposit_method'];
}
