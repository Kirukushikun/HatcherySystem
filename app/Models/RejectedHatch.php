<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RejectedHatch extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'rejected_hatch'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'is_deleted',
        
        'ps_no',
        'production_date',
        'set_eggs_qty',
        'incubator_no',
        'hatcher_no',

        'rejected_hatch_data',

        'pullout_date',
        'hatch_date',
        'rejected_total',
        'rejected_percentage',

        'encoded_by',
        'modified_by'
    ];

            /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'rejected_hatch_data' => 'array',
        
        'is_deleted' => 'boolean',
        'production_date' => 'date',
        'pullout_date' => 'date',
        'hatch_date' => 'date',

        'set_eggs_qty' => 'integer',
        'rejected_total' => 'integer',
        'rejected_total_percentage' => 'decimal:1',
    ];


}
