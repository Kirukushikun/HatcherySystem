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
        elseif($targetForm == 'master-database') 
        {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
  
    }
    public function egg_collection_result(Request $request)
    {
        // Fetching inputs
        $ps_no = $request->input('ps_no');
        $house_no = $request->input('house_no');  // This might be an array if it's a multi-select field
        $date_from = $request->input('production_date_from');
        $date_to = $request->input('production_date_to');
        $collection_time = "";

        // If only PS number is provided and other fields are empty, fetch all house numbers
        if ($ps_no && (empty($house_no) && empty($date_from) && empty($date_to))) {
            // Fetch all distinct house_no values for the given PS No
            $house_no = EggCollection::where('ps_no', $ps_no)
                ->distinct()
                ->orderBy('house_no', 'asc')
                ->pluck('house_no');


            return response()->json([
                'success' => true,
                'house_no' => $house_no,  // Return all distinct houses under that PS No
            ]);
        }

        // Build the query for egg collection based on provided filters
        $egg_quantity_query = EggCollection::where('ps_no', $ps_no);

        // Apply house filter if provided
        if (!empty($house_no)) {
            // Assuming house_no can be an array of selected house numbers
            $egg_quantity_query->whereIn('house_no', $house_no);
        }

        // Apply date range filter if provided
        if ($date_from && $date_to) {
            $egg_quantity_query->whereBetween('production_date', [$date_from, $date_to]);
        }

        // If date_from equals date_to, filter further by collection_time
        if ($date_from == $date_to && $date_from) {
            // Fetch collection_time for the exact date and ps_no
            $collection_time = EggCollection::where('production_date', $date_from)
                ->where('ps_no', $ps_no)
                ->pluck('collection_time')
                ->first();  // Get the first collection_time, or null if not found

            // If collection_time is found, apply it to the query
            if ($collection_time) {
                $egg_quantity_query->where('collection_time', $collection_time);
            }
        }

        // Get the total collected quantity within the given filters
        $egg_quantity_result = $egg_quantity_query->sum('collected_qty');  // Ensure your column name is correct

        // Group by house_no and get sum per house
        $egg_quantity_breakdown = $egg_quantity_query
            ->selectRaw('house_no, SUM(collected_qty) as total_collected')
            ->groupBy('house_no')
            ->orderBy('house_no', 'asc')
            ->pluck('total_collected', 'house_no'); // returns key => value pair

        if ($egg_quantity_result !== null) {
            return response()->json([
                'success' => true,
                'egg_quantity_result' => $egg_quantity_result,
                'egg_quantity_breakdown' => $egg_quantity_breakdown,
                'collection_time' => $collection_time,  // Only if relevant
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No egg collection data found for the given parameters.',
            ]);
        }
    }

    
}
