<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterDB;

class MasterDatabaseController extends Controller
{   
    function master_database_index() {
        // Get the latest data entry (most recent record)
        $latestData = MasterDB::orderBy('created_at', 'desc')->first();

        // Default values (for an empty database)
        $batch_no = null;
        $current_step = null;
        $batchData = [];

        if ($latestData) {
            $batch_no = $latestData->batch_no;

            // Get all records for the latest batch
            $batchCollection = MasterDB::where('batch_no', $batch_no)
                ->get();

            // Find the latest step for this batch // Exclude Step 13 from the steps list
            $latestStep = MasterDB::where('batch_no', $batch_no)
                ->where('current_step', '!=', 11)
                ->where('current_step', '!=', 13) // Ignore Step 13
                ->orderBy('current_step', 'desc') // Get the latest step
                ->first();

            // Check if step 2 exists (since it's a key step)
            $step2Entry = $batchCollection->where('current_step', 2)->first();

            if ($step2Entry && $step2Entry->status == 'in_progress') {
                // Batch is still in progress, continue from the latest step
                $current_step = $latestStep->current_step;

                $batchData = MasterDB::where('batch_no', $batch_no)->get()->toArray();

            } elseif ($step2Entry && ($step2Entry->status == 'completed' || $step2Entry->is_deleted)) {
                // Batch is completed or deleted, start a new batch
                $batch_no += 1;
                $current_step = 1;
            }
        }
    
        return view('hatchery.master_database', compact('batch_no', 'current_step', 'batchData'));
    }
    

    function master_database_store(Request $request){
        $batchNo = $request->batch_no ?? 1;
        $currentStep = $request->current_step;
    
        // Check if an entry for this batch and step already exists
        $entry = MasterDB::where('batch_no', $batchNo)
                         ->where('current_step', $currentStep)
                         ->first();
    
        if ($entry) {
            // If exists, update process_data
            $entry->process_data = $request->process_data;
            $entry->save();
            $message = "Master Database Entry Updated Successfully";
        } else {
            // Otherwise, create a new entry
            $entry = new MasterDB();
            $entry->batch_no = $batchNo;
            $entry->current_step = $currentStep;
            $entry->process_data = $request->process_data;
    
            // Step 1 is the only one that initializes a batch
            $entry->status = ($currentStep == 2) ? 'in_progress' : null;
            $entry->save();
            $message = "Master Database Entry Recorded Successfully";
        }
    
        // Define steps that must be present
        $stepsToCheck = range(2, 13);
    
        // Get the count of recorded steps within the batch
        $existingStepsCount = MasterDB::where('batch_no', $batchNo)
            ->whereIn('current_step', $stepsToCheck)
            ->distinct()
            ->count('current_step');
    
        // If all steps (2 to 13) are present, mark step 2 as completed
        $step2 = MasterDB::where('batch_no', $batchNo)->where('current_step', 2)->first();
    
        if ($step2 && $existingStepsCount === count($stepsToCheck)) {
            $step2->status = 'completed';
            $step2->save();
        }
    
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
    

    function master_database_check($batchNumber, $currentStep) {
        $exists = MasterDB::where('batch_no', $batchNumber)
                          ->where('current_step', $currentStep)
                          ->exists();
    
        return response()->json([
            'exists' => $exists, // This should be `exists` instead of `success`
            'message' => $exists ? 'Data Exists' : 'No Data Found'
        ]);
    }

    function master_database_delete($targetBatch) {
        $targetData = MasterDB::where('batch_no', $targetBatch)->get();
    
        if ($targetData->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }
    
        // Update step 2 status to 'completed' if it exists
        MasterDB::where('batch_no', $targetBatch)
            ->where('current_step', 2)
            ->update(['status' => 'completed']);
    
        // Soft delete the records
        foreach ($targetData as $data) {
            $data->is_deleted = true;
            $data->save();
        }
    
        return response()->json(['success' => true, 'message' => 'Master Database Record Deleted Successfully']);
    }

    function master_database_view($targetBatch)
    {
        // Define the expected steps in order
        $expectedSteps = [
            "collected_eggs",
            "classification_for_storage",
            "storage_pullout",
            "setter_process",
            "candling_process",
            "egg_temperature_check",
            "hatcher_pullout",
            "sexing",
            "qc_qa_process",
            "forecast",
            "dispath_process",
            "frcst_box"
        ];

        // Fetch and sort the data by current_step
        $targetData = MasterDB::where('batch_no', $targetBatch)
            ->orderBy('current_step', 'asc')
            ->get();

        // Create an associative array with process names as keys
        $organizedData = [];
        foreach ($targetData as $item) {
            $processData = is_string($item->process_data) 
                ? json_decode($item->process_data, true) 
                : $item->process_data;

            $processKey = key($processData); // Extract the step name (e.g., "collected_eggs")
            $organizedData[$processKey] = $processData;
        }

        // Ensure all steps exist in the correct order, filling missing ones with empty objects
        $finalData = [];
        foreach ($expectedSteps as $step) {
            $finalData[] = isset($organizedData[$step]) ? $organizedData[$step] : [$step => (object)[]];
        }

        return response()->json($finalData);
    }

    
    
}
