<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Audit;

class AuditTrailTable extends Component
{
    public function fetchData(Request $request){
        $query = Audit::query()->orderBy('created_at', 'desc');

        // Search Handling
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('action', 'like', "%{$searchTerm}%")
                    ->orWhere('table', 'like', "%{$searchTerm}%");
            });
        }
    
        // Sorting Handling
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'desc');

        // Check if sorting by 'data_category'
        if ($sortBy === 'data_category') {
            $query->orderByRaw("
                CASE 
                    WHEN data_category' = 'ps_no' THEN 1
                    WHEN data_category' = 'house_no' THEN 2
                    WHEN data_category' = 'incubator_no' THEN 3
                    WHEN data_category' = 'hatch_no' THEN 4
                    ELSE 5
                END $sortOrder
            ");
        } else
        {
            $query->orderBy($sortBy, $sortOrder);
        }
        // Pagination Handling
        $data = $query->paginate(7);
    
        return response()->json([
            'data' => $data->items(),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'total' => $data->total(),
        ]);
    }
}
