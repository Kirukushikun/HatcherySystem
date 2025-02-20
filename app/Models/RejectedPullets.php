<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RejectedPullets extends Model
{
    protected $table = 'rejected_pullets';
    
    protected $fillable = [
        'is_deleted',
        
        'ps_no',
        'production_date',
        'set_eggs_qty',
        'incubator_no',
        'hatcher_no',

        'rejected_pullets_data',

        'pullout_date',
        'hatch_date',
        'qc_date',
        'rejected_total',
        'rejected_percentage',

        'encoded_by',
        'modified_by'
    ];

    protected $casts = [
        'rejected_pullets_data' => 'array',
        
        'is_deleted' => 'boolean',
        'production_date' => 'date',
        'pullout_date' => 'date',
        'hatch_date' => 'date',
        'qc_date' => 'date',

        'set_eggs_qty' => 'integer',
        'rejected_total' => 'integer',
        'rejected_total_percentage' => 'decimal:1',
    ];

}
