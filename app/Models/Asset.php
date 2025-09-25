<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'sort_number',
        'item_code',
        'register',
        'name',
        'merk',
        'machine_number',
        'material',
        'acquisition_source',
        'acquisition_year',
        'specification',
        'unit',
        'condition',
        'qty',
        'price',
        'notes',
    ];
}
