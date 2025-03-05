<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterDB;

class MasterDatabaseController extends Controller
{   
    function master_database_index(){
        $latestData = MasterDB::orderBy('created_at', 'desc')->first();

        if ($latestData) {
            $batchData = MasterDB::where('batch_no', $latestData->batch_no)->get();
        
            // Find the record where current_step == 2
            $latestBatch = $batchData->where('current_step', 2)->first();
        }

        return view('hatchery.master_database', [
            'batch_no' => $latestBatch->batch_no ?? '',
            'current_step' => $latestBatch->current_step ?? 1,
        ]);
    }

    function master_database_store(Request $request){
        $entry = new MasterDB();
        $entry->batch_no = $request->batch_no ?? 1;
        $entry->current_step = $request->current_step + 1;
        $entry->process_data = $request->process_data;
        $entry->save();

        return response()->json([
            'success' => true,
            'message' => 'Master Database Entry Recorded Successfully'
        ]);
    }
}
