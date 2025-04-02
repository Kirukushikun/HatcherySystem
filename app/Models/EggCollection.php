<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EggCollection extends Model
{
    protected $table = 'egg_collection';

    protected $fillable = [
        'is_deleted',
        'ps_no',    
        'house_no',
        'production_date',
        'collection_time',
        'collected_qty',
        'driver',
        'encoded_by',
        'modified_by',
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
        'collected_qty' => 'integer',
        'production_date' => 'date',
    ];
    
}
