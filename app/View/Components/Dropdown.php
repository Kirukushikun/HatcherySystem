<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\MaintenanceValues;

class Dropdown extends Component
{
    public $data_category;
    public $data_values;
    public $data_value;

    public function __construct($dataCategory, $dataValue = null)
    {
        $this->data_category = $dataCategory;
        $this->data_value = $dataValue;

        // Normalize category if it's left_ps_no or right_ps_no
        $dbCategory = match($dataCategory) {
            'left_ps_no', 'right_ps_no' => 'ps_no',
            default => $dataCategory,
        };

        $this->data_values = MaintenanceValues::where('data_category', $dbCategory)
                                            ->pluck('data_value')
                                            ->toArray();
        sort($this->data_values);
    }

    public function render()
    {
        return view('components.dropdown');
    }
}
