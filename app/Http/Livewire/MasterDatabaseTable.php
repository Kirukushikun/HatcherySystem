<?php

namespace App\Http\Livewire;

use App\Models\MasterDB;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class MasterDatabaseTable extends Component
{
    use WithPagination;

    public function fetchData(Request $request)
    {
        // Get search query
        $search = $request->get('search', '');

        // Get sorting parameters
        $sortBy = $request->get('sort_by', 'batch_no'); // Default: batch_no
        $sortOrder = $request->get('sort_order', 'desc'); // Default: desc

        // Get paginated batch numbers (pagination logic)
        $query = MasterDB::where('is_deleted', false)
            ->select('batch_no')
            ->groupBy('batch_no');

        // **Apply Search Filtering**
        if (!empty($search)) {
            $query->where('batch_no', 'like', "%{$search}%")
                ->orWhereRaw("JSON_SEARCH(process_data, 'one', ?) IS NOT NULL", ["%{$search}%"]);;
        }

        $paginatedData = $query->orderBy($sortBy, $sortOrder)->paginate(10);
        $batchNumbers = $paginatedData->pluck('batch_no');

        // Get all latest entries in one query
        $latestEntries = MasterDB::whereIn('batch_no', $batchNumbers)
            ->where('is_deleted', false)
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('batch_no');

        $batchData = [];

        foreach ($batchNumbers as $batch_no) {
            $batchEntry = ['batch_no' => $batch_no];

            // Get latest entry for the batch
            $latestEntry = $latestEntries[$batch_no]->first() ?? null;

            $batchEntry['date_encoded'] = $latestEntry 
                ? $latestEntry->created_at->format('d-m-Y') 
                : 'N/A';

            // Retrieve all steps for this batch in one query
            $completedSteps = MasterDB::where('batch_no', $batch_no)
                ->whereIn('current_step', range(2, 11)) // Exclude Step 10 and 11
                ->pluck('current_step')
                ->toArray();

            // Loop through steps and check if it's in completedSteps array
            for ($step = 2; $step <= 11; $step++) {
                $batchEntry[$step] = in_array($step, $completedSteps) ? 'Done' : 'Pending';
            }

            $batchData[] = $batchEntry;
        }

        // **Sorting Logic**
        usort($batchData, function ($a, $b) use ($sortBy, $sortOrder) {
            if ($sortBy === 'batch_no') {
                return $sortOrder === 'asc' ? $a['batch_no'] <=> $b['batch_no'] : $b['batch_no'] <=> $a['batch_no'];
            }
            if ($sortBy === 'date_encoded') {
                return $sortOrder === 'asc' 
                    ? strtotime($a['date_encoded']) <=> strtotime($b['date_encoded']) 
                    : strtotime($b['date_encoded']) <=> strtotime($a['date_encoded']);
            }
            return 0;
        });

        return response()->json([
            'batchData' => $batchData,
            'paginatedData' => $paginatedData
        ]);
    }

}
