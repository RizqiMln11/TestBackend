<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class report extends Model
{
    use HasFactory;
    protected $fillable = ['from_cust_id', 'to_staff_id', 'cust_defendant_id', 'casses'];
}
