<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EggCollection;

class ReportController extends Controller
{
    public function generateReport($targetForm){

        if($targetForm == 'egg-collection') 
        {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
        elseif($targetForm == 'egg-temperature') 
        {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
        elseif($targetForm == 'rejected-hatch') 
        {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
        elseif($targetForm == 'rejected-pullets') 
        {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
  
    }
    public function egg_collection_result(Request $request){
        $ps_no = $request->input('ps_no');
        $date_from = $request->input('production_date_from');
        $date_to = $request->input('production_date_to');
        $collection_time = "";
    
        // Check if the dates are the same
        if($date_from == $date_to){
            // Fetch collection_time for the exact date and ps_no
            $collection_time = EggCollection::where('production_date', $date_from)
                ->where('ps_no', $ps_no)
                ->pluck('collection_time')
                ->first(); // Get the first collection_time, or null if not found
        }
    
        // Query the egg collection data based on ps_no and the date range
        $egg_quantity_query = EggCollection::where('ps_no', $ps_no)
            ->whereBetween('production_date', [$date_from, $date_to]);
    
        // If collection_time is found and dates are the same, filter by collection_time as well
        if ($collection_time && $date_from == $date_to) {
            $egg_quantity_query->where('collection_time', $collection_time);
        }
    
        // Get the total collected quantity within the given date range (and collection_time if the dates are the same)
        $egg_quantity_result = $egg_quantity_query->sum('collected_qty');
    
        // Return the result as JSON
        return response()->json([
            'success' => true,
            'egg_quantity_result' => $egg_quantity_result,
            'collection_time' => $collection_time,  // Return the found collection_time (if any)
        ]);
    }
    
}
