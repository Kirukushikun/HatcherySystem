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
        // Fetch paginated data first
        $paginated = MasterDB::select('batch_no', 'process_data')
            ->orderBy('batch_no')
            ->paginate(10);

        // Group the fetched data by batch_no
        $batches = collect($paginated->items())
            ->groupBy('batch_no')
            ->map(function ($processes) {
                return [
                    'batch_no' => $processes->first()->batch_no,
                    'processes' => $processes->map(fn($process) => $process->process_data) // No json_decode() needed
                ];
            })
            ->values(); // Reset array keys

        return response()->json([
            'data' => $batches,
            'current_page' => $paginated->currentPage(),
            'last_page' => $paginated->lastPage(),
            'total' => $paginated->total(),
        ]);
    }
}
