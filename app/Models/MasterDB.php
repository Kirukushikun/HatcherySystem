<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterDB extends Model
{
    protected $table = 'master_db'; // Make sure this matches your migration

    protected $fillable = [
        'is_deleted',
        'batch_no',
        'current_step',
        'process_data',
    ];

    protected $casts = [
        'is_deleted' => 'boolean',
        'batch_no' => 'integer',
        'current_step' => 'integer',
        'process_data' => 'array',
    ];
}
