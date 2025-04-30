<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\EggTemperature;

class EggTemperatureTable extends Component
{   
    use WithPagination;    
    
    public function fetchData(Request $request){

        $query = EggTemperature::where('is_deleted', false);

        //Search Handling
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('ps_no', 'like', "%{$searchTerm}%")
                    ->orWhere('setting_date', 'like', "%{$searchTerm}%")
                    ->orWhere('incubator_no', 'like', "%{$searchTerm}%")
                    ->orWhere('location', 'like', "%{$searchTerm}%")
                    ->orWhere('temperature_check_date', 'like', "%{$searchTerm}%")
                    ->orWhere('temperature', 'like', "%{$searchTerm}%")
                    ->orWhere('quantity', 'like', "%{$searchTerm}%");  
            });
        }

        // Sorting Handling
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'asc');

        // Check if sorting by 'location' (Top > Mid > Low)
        if ($sortBy === 'location') {
            $query->orderByRaw("
                CASE 
                    WHEN location = 'Top' THEN 1
                    WHEN location = 'Mid' THEN 2
                    WHEN location = 'Low' THEN 3
                    ELSE 4
                END $sortOrder
            ");
        } 
        // Check if sorting by 'temperature' (37.8 Above > 37.7 Below)
        else if ($sortBy === 'temperature') {
            $query->orderByRaw("
                CASE 
                    WHEN temperature LIKE '37.8%' THEN 1
                    WHEN temperature LIKE '37.7%' THEN 2
                    ELSE 3
                END $sortOrder
            ");
        } 
        // Ensure 'quantity' sorts as a number (in case of string issues)
        else if ($sortBy === 'quantity') {
            $query->orderByRaw("CAST(quantity AS SIGNED) $sortOrder");
        } 
        // Default sorting for other columns
        else {
            $query->orderBy($sortBy, $sortOrder);
        }

        //Pagination Handling
        $data = $query->paginate(10);

        return response()->json([
            'data' => $data->items(),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'total' => $data->total(),
        ]);

    }
}
