<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterDB;

class MasterDatabaseController extends Controller
{   
    function master_database_index() {
        // Get the latest data entry
        $latestData = MasterDB::orderBy('created_at', 'desc')->first();
    
        // Default values (for when there's no data)
        $batch_no = null;
        $current_step = null;
    
        if ($latestData) {
            $batch_no = $latestData->batch_no;
    
            // Get all records for the latest batch
            $batchCollection = MasterDB::where('batch_no', $batch_no)->get();
    
            // Find step 2 entry (if exists)
            $latestBatch = $batchCollection->where('current_step', 2)->first();
    
            // Find the latest step in the batch
            $latestStep = $batchCollection->sortByDesc('current_step')->first();
    
            // Ensure we don’t access properties of null
            if ($latestBatch && $latestBatch->status == 'in_progress') {
                $batch_no = $latestBatch->batch_no;
                $current_step = $latestStep->current_step;
            }
        }
    
        return view('hatchery.master_database', compact('batch_no', 'current_step'));
    }
    

    function master_database_store(Request $request){
        $batchNo = $request->batch_no ?? 1;
        $currentStep = $request->current_step;
        
        // Create a new entry
        $entry = new MasterDB();
        $entry->batch_no = $batchNo;
        $entry->current_step = $currentStep + 1;
        $entry->process_data = $request->process_data;
        
        // Step 1 is the only one that initializes a batch
        $entry->status = ($currentStep == 1) ? 'in_progress' : null;
        $entry->save();
        
        // Define steps that must be present
        $stepsToCheck = range(2, 11);

        // Get the count of recorded steps within the batch
        $existingStepsCount = MasterDB::where('batch_no', $batchNo)
            ->whereIn('current_step', $stepsToCheck)
            ->distinct()
            ->count('current_step');

        // If all steps (2 to 11) are present, mark step 2 as completed
        $step2 = MasterDB::where('batch_no', $batchNo)->where('current_step', 2)->first();

        if ($step2 && $existingStepsCount === count($stepsToCheck)) {
            $step2->status = 'completed';
            $step2->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Master Database Entry Recorded Successfully'
        ]);
    }
}
