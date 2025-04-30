<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceValues extends Model
{

    protected $table = 'value_maintenance';

    protected $fillable = [
        'data_category',
        'data_value'
    ];
}
