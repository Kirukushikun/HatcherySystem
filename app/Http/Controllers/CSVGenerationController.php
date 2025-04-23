<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EggCollection;

class CSVGenerationController extends Controller
{
    public function egg_collection_csv(){
        $records = EggCollection::where('is_deleted', false)->get();

        // Define CSV headers
        $csv = "PS No,House No,Production Date,Collection Time,Collected Eggs Qty,Driver Name, Encoded/Modified By\n";

        foreach ($records as $record) {
            // Format the production_date in the desired format (e.g., Y-m-d)
            $formattedProductionDate = \Carbon\Carbon::parse($record->production_date)->format('Y-m-d');
            // Format the collection_time in the desired format (e.g., h:i A)
            $formattedTime = \Carbon\Carbon::parse($record->collection_time)->format('h:i A');
            
            $csv .= "{$record->ps_no},{$record->house_no},{$formattedProductionDate},{$formattedTime},{$record->collected_qty}, {$record->driver_name}, {$record->encoded_by}\n";
        }

        $filename = "egg_collection_" . now()->format('Ymd_His') . ".csv";

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
