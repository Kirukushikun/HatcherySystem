<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EggCollection;
use App\Models\EggTemperature;
use App\Models\RejectedHatch;
use App\Models\RejectedPullets;

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

    public function egg_temperature_csv(){
        
        $records = EggTemperature::where('is_deleted', false)->get();

        // Define CSV headers
        $csv = "Temp Check QTY,Overall Above Temp QTY,Overall Above Temp %,Overall Below Temp QTY,Overall Below Temp %,";
        $csv .= "Left PS No,Left Above Temp QTY,Left Above Temp %,Left Below Temp QTY,Left Below Temp %,Left Total Qty,";
        $csv .= "Right PS No,Right Above Temp QTY,Right Above Temp %,Right Below Temp QTY,Right Below Temp %,Right Total Qty,";
        $csv .= "Temp Check Date,Setting Date,Hatch Date\n";
    
        foreach ($records as $record){
            $jsonData = json_decode($record->egg_temperature_data, true);
    
            $left = $jsonData['left'] ?? [];
            $right = $jsonData['right'] ?? [];
    
            // LEFT
            $leftPsNo = $left['ps_no'] ?? '';
            $leftAboveQty = $left['above_temp_qty'] ?? '';
            $leftAbovePrcnt = $left['above_temp_prcnt'] ?? '';
            $leftBelowQty = $left['below_temp_qty'] ?? '';
            $leftBelowPrcnt = $left['below_temp_prcnt'] ?? '';
            $leftTotal = $left['total_qty'] ?? '';
    
            // RIGHT
            $rightPsNo = $right['ps_no'] ?? '';
            $rightAboveQty = $right['above_temp_qty'] ?? '';
            $rightAbovePrcnt = $right['above_temp_prcnt'] ?? '';
            $rightBelowQty = $right['below_temp_qty'] ?? '';
            $rightBelowPrcnt = $right['below_temp_prcnt'] ?? '';
            $rightTotal = $right['total_qty'] ?? '';
    
            // Dates
            $formattedTempCheckDate = \Carbon\Carbon::parse($record->temp_check_date)->format('Y-m-d');
            $formattedSettingDate = \Carbon\Carbon::parse($record->setting_date)->format('Y-m-d');
            $formattedHatchDate = \Carbon\Carbon::parse($record->hatch_date)->format('Y-m-d');
    
            // Build row
            $csv .= "{$record->temp_check_qty},{$record->ovrl_above_temp_qty},{$record->ovrl_above_temp_prcnt},{$record->ovrl_below_temp_qty},{$record->ovrl_below_temp_prcnt},";
            $csv .= "{$leftPsNo},{$leftAboveQty},{$leftAbovePrcnt},{$leftBelowQty},{$leftBelowPrcnt},{$leftTotal},";
            $csv .= "{$rightPsNo},{$rightAboveQty},{$rightAbovePrcnt},{$rightBelowQty},{$rightBelowPrcnt},{$rightTotal},";
            $csv .= "{$formattedTempCheckDate},{$formattedSettingDate},{$formattedHatchDate}\n";
        }
    
        $filename = "egg_temperature_" . now()->format('Ymd_His') . ".csv";
    
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }
}
