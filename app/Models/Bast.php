<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bast extends Model
{
    protected $fillable = [
        'asset_id',
        'employee_id',
        'file_id',
        'bast_number',
        'bast_date',
        'status',
    ];
}
