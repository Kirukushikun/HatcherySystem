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

    public function rejected_hatch_csv(){
        $records = RejectedHatch::where('is_deleted', false)->get();

        // Define CSV headers
        $csv = "PS No,Settable Eggs QTY,Incubator No,Hatcher No,";
        $csv .= "Unhatched QTY,Unhatched %, Pips QTY,Pips %,Rejected Chicks QTY,Rejected Chicks %,Dead Chicks QTY,Dead Chicks %,Rotten QTY,Rotten %,Rejected Total QTY,Rejected Total %,";
        $csv .= "Production Date (From),Production Date (To),Hatch Date,QC Date\n";

        foreach ($records as $record){

            $formattedIncubatorNos = is_array($record->incubator_no)
                ? '"' . implode(', ', $record->incubator_no) . '"'
                : $record->incubator_no;
        
            $formattedHatcherNos = is_array($record->hatcher_no)
                ? '"' . implode(', ', $record->hatcher_no) . '"'
                : $record->hatcher_no;

            $jsonData = json_decode($record->rejected_hatch_data, true);

            $unhatched = $jsonData['unhatched'] ?? [];
            $pips = $jsonData['pips'] ?? [];
            $rejectedChicks = $jsonData['rejected_chicks'] ?? [];
            $deadChicks = $jsonData['dead_chicks'] ?? [];
            $rotten = $jsonData['rotten'] ?? [];

            $unhatchedQty = $unhatched['qty'] ?? '';
            $unhatchedPrcnt = $unhatched['percentage'] ?? '';

            $pipsQty = $pips['qty'] ?? '';
            $pipsPrcnt = $pips['percentage'] ?? '';

            $rejectedChicksQty = $rejectedChicks['qty'] ?? '';
            $rejectedChicksPrcnt = $rejectedChicks['percentage'] ?? '';

            $deadChicksQty = $deadChicks['qty'] ?? '';
            $deadChicksPrcnt = $deadChicks['percentage'] ?? '';

            $rottenQty = $rotten['qty'] ?? '';
            $rottenPrcnt = $rotten['percentage'] ?? '';

            $formattedProductionDateFrom = \Carbon\Carbon::parse($record->production_date_from)->format('Y-m-d');
            $formattedProductionDateTo = \Carbon\Carbon::parse($record->production_date_to)->format('Y-m-d');
            $formattedHatchDate = \Carbon\Carbon::parse($record->hatch_date)->format('Y-m-d');
            $formattedQcDate = \Carbon\Carbon::parse($record->qc_date)->format('Y-m-d');

            // Build row
            $csv .= "{$record->ps_no},{$record->set_eggs_qty},{$formattedIncubatorNos},{$formattedHatcherNos},";
            $csv .= "{$unhatchedQty},{$unhatchedPrcnt},{$pipsQty},{$pipsPrcnt},{$rejectedChicksQty},{$rejectedChicksPrcnt},{$deadChicksQty},{$deadChicksPrcnt},{$rottenQty},{$rottenPrcnt},{$record->rejected_total},{$record->rejected_total_percentage},";
            $csv .= "{$formattedProductionDateFrom},{$formattedProductionDateTo},{$formattedHatchDate},{$formattedQcDate}\n";
        }

        $filename = "rejected_hatch_" . now()->format('Ymd_His') . ".csv";
    
        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

    public function rejected_pullets_csv()
    {
        $records = RejectedPullets::where('is_deleted', false)->get();

        // Define CSV headers
        $csv = "PS No,Settable Eggs QTY,Incubator No,Hatcher No,";
        $csv .= "Singkit Mata QTY,Singkit Mata %,Wala Mata QTY,Wala Mata %,Maliit Mata QTY,Maliit Mata %,Malaki Mata QTY,Malaki Mata %,";
        $csv .= "Unhealed Navel QTY,Unhealed Navel %,Cross Beak QTY,Cross Beak %,Small Chick QTY,Small Chick %,Weak Chick QTY,Weak Chick %,";
        $csv .= "Black Bottons QTY,Black Bottons %,String Navel QTY,String Navel %,Bloated QTY,Bloated %,";
        $csv .= "Rejected Total QTY,Rejected Total %,Production Date (From),Production Date (To),Hatch Date,QC Date\n";

        foreach ($records as $record) {

            $formattedIncubatorNos = is_array($record->incubator_no)
                ? '"' . implode(', ', $record->incubator_no) . '"'
                : $record->incubator_no;

            $formattedHatcherNos = is_array($record->hatcher_no)
                ? '"' . implode(', ', $record->hatcher_no) . '"'
                : $record->hatcher_no;

            $jsonData = json_decode($record->rejected_pullets_data, true); // note the different field

            // Helper to extract values
            $get = fn($key, $type = 'qty') => $jsonData[$key][$type] ?? '';

            // Dates
            $formattedProductionDateFrom = \Carbon\Carbon::parse($record->production_date_from)->format('Y-m-d');
            $formattedProductionDateTo = \Carbon\Carbon::parse($record->production_date_to)->format('Y-m-d');
            $formattedHatchDate = \Carbon\Carbon::parse($record->hatch_date)->format('Y-m-d');
            $formattedQcDate = \Carbon\Carbon::parse($record->qc_date)->format('Y-m-d');

            // Build row
            $csv .= "{$record->ps_no},{$record->set_eggs_qty},{$formattedIncubatorNos},{$formattedHatcherNos},";
            $csv .= "{$get('singkit_mata')},{$get('singkit_mata', 'percentage')},";
            $csv .= "{$get('wala_mata')},{$get('wala_mata', 'percentage')},";
            $csv .= "{$get('maliit_mata')},{$get('maliit_mata', 'percentage')},";
            $csv .= "{$get('malaki_mata')},{$get('malaki_mata', 'percentage')},";
            $csv .= "{$get('unhealed_navel')},{$get('unhealed_navel', 'percentage')},";
            $csv .= "{$get('cross_beak')},{$get('cross_beak', 'percentage')},";
            $csv .= "{$get('small_chick')},{$get('small_chick', 'percentage')},";
            $csv .= "{$get('weak_chick')},{$get('weak_chick', 'percentage')},";
            $csv .= "{$get('black_bottons')},{$get('black_bottons', 'percentage')},";
            $csv .= "{$get('string_navel')},{$get('string_navel', 'percentage')},";
            $csv .= "{$get('bloated')},{$get('bloated', 'percentage')},";
            $csv .= "{$record->rejected_total},{$record->rejected_total_percentage},";
            $csv .= "{$formattedProductionDateFrom},{$formattedProductionDateTo},{$formattedHatchDate},{$formattedQcDate}\n";
        }

        $filename = "rejected_pullets_" . now()->format('Ymd_His') . ".csv";

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ]);
    }

}
