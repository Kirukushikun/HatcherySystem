<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterDB;

class MasterDatabaseController extends Controller
{
    function master_database_store(Request $request){
        $entry = new MasterDB();
        $entry->batch_no = 1;
        $entry->current_step = $request->current_step;
        $entry->process_data = $request->process_data;
        $entry->save();

        return response()->json([
            'success' => true,
            'message' => 'Master Database Entry Recorded Successfully'
        ]);
    }
}
