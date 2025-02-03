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
        'ps_no',
        'setting_date',
        'incubator',
        'location',

        'temperature',
        'temperature_check_date',
        'quantity',

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
        'quantity' => 'integer',
        'setting_date' => 'date',
        'temperature_check_date' => 'date',
    ];

}
