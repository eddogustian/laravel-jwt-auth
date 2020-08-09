<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name', 'email', 'phone', 'emp_id', 'company', 'location'
    ];
}
