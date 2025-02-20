<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\MaintenanceValues;

class Dropdown extends Component
{
    public $data_category;
    public $data_values;

    public function __construct($dataCategory)
    {
        $this->data_category = $dataCategory;
        $this->data_values = MaintenanceValues::where('data_category', $dataCategory)
                                             ->pluck('data_value')
                                             ->toArray();
    }

    public function render()
    {
        return view('components.dropdown');
    }
}
