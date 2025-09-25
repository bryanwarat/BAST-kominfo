<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BastFile extends Model
{
    protected $table = 'bast_files';
    
    protected $fillable = [
        'bast_id',
        'document',
        'photo',
    ];
}
