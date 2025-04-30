<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\MaintenanceValues;

class MultiselectDropdown extends Component
{
    public $data_category;
    public $data_values;
    public $selected_values;

    public function __construct($dataCategory, $dataValue = [])
    {
        $this->data_category = $dataCategory;

        // Ensure selected values are always an array
        $this->selected_values = is_array($dataValue) ? $dataValue : json_decode($dataValue, true);

        // Fetch and sort all values from the database
        $this->data_values = MaintenanceValues::where('data_category', $dataCategory)
                                              ->pluck('data_value')
                                              ->sort()
                                              ->values()
                                              ->toArray();
    }

    public function render()
    {
        return view('components.multiselect-dropdown');
    }
}
// This component is designed to handle a multi-select dropdown in a Laravel application.
// It fetches values from the MaintenanceValues model based on a given data category.
// The selected values are passed as an array, and the component ensures that they are always treated as such.
// The component also sorts the fetched values before passing them to the view.
// The render method returns the view associated with this component, which is 'components.multiselect-dropdown'.
// This allows for easy integration of the component into Blade templates, enabling the use of a multi-select dropdown with dynamic values.
// The component is designed to be reusable and can be easily extended or modified as needed.