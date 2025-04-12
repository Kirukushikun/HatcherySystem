<?php
namespace App\Http\Livewire;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Http\Request;
use App\Models\EggCollection;
class EggCollectionTable extends Component
{   
    use WithPagination;    
    
    public function fetchData(Request $request){
        $query = EggCollection::where('is_deleted', false);

        //Search Handling
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('ps_no', 'like', "%{$searchTerm}%")
                    ->orWhere('house_no', 'like', "%{$searchTerm}%")
                    ->orWhere('production_date', 'like', "%{$searchTerm}%")
                    ->orWhere('collection_time', 'like', "%{$searchTerm}%")
                    ->orWhere('collected_qty', 'like', "%{$searchTerm}%");  
            });
        }
        // Sorting Handling
        $sortBy = $request->get('sort_by', 'created_at');
        $sortOrder = $request->get('sort_order', 'asc');
        
        // Ensure 'collected_qty' sorts as a number (in case of string issues)
        if ($sortBy === 'collected_qty') {
            $query->orderByRaw("CAST(collected_qty AS SIGNED) $sortOrder");
        } 
        // Default sorting for other columns
        else {
            $query->orderBy($sortBy, $sortOrder);
        }
        //Pagination Handling
        $data = $query->paginate(10);

        // Decode house_no for each record if it's JSON
        $data->getCollection()->transform(function ($item) {
            if (is_string($item->house_no) && str_starts_with($item->house_no, '[')) {
                $item->house_no = json_decode($item->house_no);
            }
            return $item;
        });
        
        return response()->json([
            'data' => $data->items(),
            'current_page' => $data->currentPage(),
            'last_page' => $data->lastPage(),
            'total' => $data->total(),
        ]);
    }
}