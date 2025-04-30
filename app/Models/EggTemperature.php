<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EggTemperature extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'egg_temperature'; // Ensure this matches your table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_deleted',

        'temp_check_date',
        'setting_date',
        'hatch_date',

        'temp_check_qty',
        'ovrl_above_temp_qty',
        'ovrl_above_temp_prcnt',
        'ovrl_below_temp_qty',
        'ovrl_below_temp_prcnt',

        'egg_temperature_data',

        'encoded_by',
        'modified_by'
    ];

        /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_deleted' => 'boolean',

        'temp_check_date' => 'date',
        'setting_date' => 'date',
        'hatch_date' => 'date',

        'temp_check_qty' => 'integer',
        'ovrl_above_temp_qty' => 'integer',
        'ovrl_above_temp_prcnt' => 'decimal:1',
        'ovrl_below_temp_qty' => 'integer',
        'ovrl_below_temp_prcnt' => 'decimal:1',

        'egg_temperature_data' => 'array',
    ];

}
