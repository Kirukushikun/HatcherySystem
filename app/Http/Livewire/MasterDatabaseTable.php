<?php

namespace App\Http\Livewire;

use App\Models\MasterDB;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class MasterDatabaseTable extends Component
{
    use WithPagination;

    // public function fetchData(Request $request)
    // {
    //     // Get unique batch numbers sorted
    //     $batchNumbers = MasterDB::where('is_deleted', false)
    //         ->select('batch_no')
    //         ->groupBy('batch_no')
    //         ->orderBy('batch_no', 'asc')
    //         ->pluck('batch_no');  // Retrieves only batch_no values

    //     $batchData = [];

    //     foreach ($batchNumbers as $batch_no) {
    //         // Initialize batch entry
    //         $batchEntry = ['batch_no' => $batch_no];

    //         // Get the latest entry for this batch
    //         $latestEntry = MasterDB::where('batch_no', $batch_no)
    //         ->where('is_deleted', false)
    //         ->orderBy('created_at', 'desc')
    //         ->first();

    //         $batchEntry = ['date_encoded' => $latestEntry->created_at->format('d-m-Y')];

    //         // Loop through the step range (modify range if needed)
    //         for ($step = 2; $step <= 12; $step++) {
    //             $hasStep = MasterDB::where('batch_no', $batch_no)
    //                 ->where('current_step', $step)
    //                 ->exists();

    //             $batchEntry[$step] = $hasStep ? 'Done' : 'Pending';
    //         }

    //         $batchData[] = $batchEntry;
    //     }

    //     return response()->json($batchData);
    // }

    public function fetchData(Request $request)
    {
        // Get unique batch numbers sorted
        $batchNumbers = MasterDB::where('is_deleted', false)
            ->select('batch_no')
            ->groupBy('batch_no')
            ->orderBy('batch_no', 'asc')
            ->pluck('batch_no');

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
                ->whereIn('current_step', range(2, 12))
                ->pluck('current_step')
                ->toArray();

            // Loop through steps and check if it's in completedSteps array
            for ($step = 2; $step <= 12; $step++) {
                $batchEntry[$step] = in_array($step, $completedSteps) ? 'Done' : 'Pending';
            }

            $batchData[] = $batchEntry;
        }

        return response()->json($batchData);
    }
}
