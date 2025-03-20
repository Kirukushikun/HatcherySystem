<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\RejectedHatch;

class RejectedHatchTable extends Component
{
    use WithPagination;    
    public function fetchData(Request $request){

        $query = RejectedHatch::where('is_deleted', false);

        //Search Handling
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('ps_no', 'like', "%{$searchTerm}%")
                    ->orWhere('production_date', 'like', "%{$searchTerm}%")
                    ->orWhere('set_eggs_qty', 'like', "%{$searchTerm}%")
                    ->orWhere('incubator_no', 'like', "%{$searchTerm}%")
                    ->orWhere('hatcher_no', 'like', "%{$searchTerm}%")

                    ->orWhere('rejected_hatch_data', 'like', "%{$searchTerm}%")
                    
                    ->orWhere('pullout_date', 'like', "%{$searchTerm}%")
                    ->orWhere('hatch_date', 'like', "%{$searchTerm}%")
                    ->orWhere('rejected_total', 'like', "%{$searchTerm}%")
                    ->orWhere('rejected_total_percentage', 'like', "%{$searchTerm}%");
            });
        }

        // Sorting Handling
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'asc');
        
        // Ensure 'set_eggs_qty' sorts as a number (in case of string issues)
        if ($sortBy === 'set_eggs_qty') {
            $query->orderByRaw("CAST(set_eggs_qty AS SIGNED) $sortOrder");
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
