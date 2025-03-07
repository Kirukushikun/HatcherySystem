<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\Audit;

class AuditTrailTable extends Component
{
    public function fetchData(Request $request){
        $query = Audit::query();

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
        $sortOrder = $request->get('sort_order', 'asc');

        // Check if sorting by 'table'
        if ($sortBy === 'table') {
            $query->orderByRaw("
                CASE 
                    WHEN `table` = 'egg_collection' THEN 1
                    WHEN `table` = 'egg_temperature' THEN 2
                    WHEN `table` = 'rejected_hatch' THEN 3
                    WHEN `table` = 'rejected_pullets' THEN 4
                    ELSE 5
                END " . ($sortOrder === 'desc' ? 'DESC' : 'ASC')
            );
        } 
        elseif ($sortBy === 'action') {
            $query->orderByRaw("
                CASE 
                    WHEN action LIKE '%Added%' THEN 1
                    WHEN action LIKE '%Updated%' THEN 2
                    WHEN action LIKE '%Deleted%' THEN 3
                    ELSE 4
                END " . ($sortOrder === 'desc' ? 'DESC' : 'ASC')
            );
        }        
         else
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
