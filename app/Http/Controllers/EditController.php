<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AuditController as AC;

use Illuminate\Support\Facades\Crypt;

use App\Models\EggCollection;
use App\Models\EggTemperature;
use App\Models\RejectedHatch;

class EditController extends Controller
{
    public function edit_record_index($targetForm, $encryptedId){

        $targetID = Crypt::decrypt($encryptedId);

        if($targetForm == 'egg-collection'){
            $dataRecord = EggCollection::find($targetID);
        }
        elseif($targetForm == 'egg-temperature'){
            $dataRecord = EggTemperature::find($targetID);            
        }
        elseif($targetForm == 'rejected-hatch'){
            $dataRecord = RejectedHatch::find($targetID);
            $dataRecord->rejected_hatch_data = json_decode($dataRecord->rejected_hatch_data, true); // Decode JSON into array
        }

        return view('hatchery.edit_module', [
            'targetForm' => $targetForm,
            'record' => $dataRecord
        ]);
    }

    public function edit_record_update(Request $request, $targetForm, $targetID){
        if($targetForm == 'egg-collection'){
            $validator = Validator::make($request->all(), [
                'ps_no' => 'required|string|max:255',
                'house_no' => 'required|string|max:255',
                'production_date' => 'required|date',
                'collection_time' => 'required|date_format:H:i',
                'collection_eggs_quantity' => 'required|integer',
            ]);
    
            if ($validator->fails()) {
                $errorMessages = $validator->errors();
                session()->flash('form_data', $request->only(['ps_no', 'house_no', 'production_date', 'collection_time', 'collection_eggs_quantity']));
    
                if ($errorMessages->hasAny(['ps_no', 'house_no', 'production_date', 'collection_time'])) {
                    return back()->with('error', 'Saving Failed')->with('error_message', 'Please fill in all the required fields correctly.');
                }   
                if ($errorMessages->hasAny(['production_date'])) {
                    return back()->with('error', 'Invalid Date Format')->with('error_message', 'Please provide a valid date format (YYYY-MM-DD).');
                }      
                if ($errorMessages->hasAny(['collection_time'])) {
                    return back()->with('error', 'Invalid Time Format')->with('error_message', 'Please provide correct time format (HH:MM).');
                }               
                if ($errorMessages->has('collection_eggs_quantity')) {
                    return back()->with('error', 'Invalid Quantity')->with('error_message', 'Quantity must be a number.');
                }          
            }
    
            $validatedData = $validator->validated();
    
            $eggCollection = EggCollection::find($targetID);
            $eggCollection->ps_no = $validatedData['ps_no'];
            $eggCollection->house_no = $validatedData['house_no'];
            $eggCollection->production_date = $validatedData['production_date'];
            $eggCollection->collection_time = $validatedData['collection_time'];
            $eggCollection->collected_qty = $validatedData['collection_eggs_quantity'];
            $eggCollection->save();

            return redirect('/egg-collection')->with('success', 'Updated Successfully')->with('success_message', 'Egg Collection Entry Updated Successfully');
        }
        
        elseif($targetForm == 'egg-temperature'){
            $validator = Validator::make($request->all(), [
                'ps_no' => 'required|string|max:255',
                'setting_date' => 'required|date',
                'incubator' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'temp_check_date' => 'required|date',
                'temperature' => 'required|string|max:255',
                'quantity' => 'required|integer',
            ]);
    
            if ($validator->fails()) {
                $errorMessages = $validator->errors();
                session()->flash('form_data', $request->only(['ps_no', 'setting_date', 'incubator', 'location', 'temp_check_date', 'temperature', 'quantity']));
    
                if ($errorMessages->hasAny(['ps_no', 'setting_date', 'incubator', 'location', 'temp_check_date', 'temperature', 'quantity'])) {
                    return back()->with('error', 'Saving Failed')->with('error_message', 'Please fill in all the required fields correctly.');
                }   
                if ($errorMessages->has('quantity')) {
                    return back()->with('error', 'Invalid Quantity')->with('error_message', 'Quantity must be a valid integer.');
                }        
                if ($errorMessages->hasAny(['setting_date', 'temp_check_date'])) {
                    return back()->with('error', 'Invalid Date Format')->with('error_message', 'Please provide a valid date format (YYYY-MM-DD).');
                }            
            }
    
            $validatedData = $validator->validated();
    
            $eggTemperature = EggTemperature::find($targetID);
            $eggTemperature->ps_no = $validatedData['ps_no'];
            $eggTemperature->setting_date = $validatedData['setting_date'];
            $eggTemperature->incubator = $validatedData['incubator'];
            $eggTemperature->location = $validatedData['location'];
            $eggTemperature->temperature = $validatedData['temperature'];
            $eggTemperature->temperature_check_date = $validatedData['temp_check_date'];
            $eggTemperature->quantity = $validatedData['quantity'];
            $eggTemperature->save();

            return redirect('/egg-temperature')->with('success', 'Updated Successfully')->with('success_message', 'Egg Temperature Entry Updated Successfully');
        }

        elseif($targetForm == 'rejected-hatch'){
            $validator = Validator::make($request->all(), [
                'ps_no' => 'required|string|max:255',
                'production_date' => 'required|date',
                'set_eggs_qty' => 'required|integer',
                'incubator_no' => 'required|string|max:255',
                'hatcher_no' => 'required|string|max:255',
            
                'unhatched' => 'nullable|integer',
                'unhatched_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            
                'pips' => 'nullable|integer',
                'pips_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            
                'rejected_chicks' => 'nullable|integer',
                'rejected_chicks_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            
                'dead_chicks' => 'nullable|integer',
                'dead_chicks_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            
                'rotten' => 'nullable|integer',
                'rotten_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            
                'pullout_date' => 'required|date',
                'hatch_date' => 'required|date',
            
                'rejected_total' => 'required|integer',
                'rejected_total_prcnt' => 'required|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            ]);
    
            if($validator->fails()){
                $errorMessages = $validator->errors();
                session()->flash('form_data', $request->only(['ps_no', 'production_date', 'set_eggs_qty', 'incubator_no', 'hatcher_no', 'pullout_date', 'hatch_date', 'rejected_total', 'rejected_total_prcnt']));
    
                if ($errorMessages->hasAny(['ps_no', 'production_date', 'set_eggs_qty', 'incubator_no', 'hatcher_no', 'pullout_date', 'hatch_date', 'rejected_total', 'rejected_total_prcnt'])) {
                    return back()->with('error', 'Saving Failed')->with('error_message', 'Please fill in all the required fields correctly.');
                } 
                if($errorMessages->hasAny(['set_eggs_qty', 'unhatched', 'pips', 'rejected_chicks', 'dead_chicks', 'rotten', 'rejected_total'])){
                    return back()->with('error', 'Invalid Integer Format')->with('error_message', 'Input must be a valid integer.');
                }
                if($errorMessages->hasAny(['unhatched_prcnt', 'pips_prcnt', 'rejected_chicks_prcnt', 'dead_chicks_prcnt', 'rotten_prcnt', 'rejected_total_prcnt'])){
                    return back()->with('error', 'Invalid Decimal Format')->with('error_message', 'Input must be a valid decimal.');
                }
                if ($errorMessages->hasAny(['production_date', 'pullout_date', 'hatch_date'])) {
                    return back()->with('error', 'Invalid Date Format')->with('error_message', 'Please provide a valid date format (YYYY-MM-DD).');
                }  
            }        
    
            $validatedData = $validator->validated();
    
            // Encode rejected hatch data as JSON
            $rejected_hatch_data = json_encode([
                'unhatched' => [
                    'qty' => (int) ($validatedData['unhatched'] ?? 0),
                    'percentage' => (float) ($validatedData['unhatched_prcnt'] ?? 0.0)
                ],
                'pips' => [
                    'qty' => (int) ($validatedData['pips'] ?? 0),
                    'percentage' => (float) ($validatedData['pips_prcnt'] ?? 0.0)
                ],
                'rejected_chicks' => [
                    'qty' => (int) ($validatedData['rejected_chicks'] ?? 0),
                    'percentage' => (float) ($validatedData['rejected_chicks_prcnt'] ?? 0.0)
                ],
                'dead_chicks' => [
                    'qty' => (int) ($validatedData['dead_chicks'] ?? 0),
                    'percentage' => (float) ($validatedData['dead_chicks_prcnt'] ?? 0.0)
                ],
                'rotten' => [
                    'qty' => (int) ($validatedData['rotten'] ?? 0),
                    'percentage' => (float) ($validatedData['rotten_prcnt'] ?? 0.0)
                ]
            ], JSON_NUMERIC_CHECK);
    
            // //Debugging
            // $formattedJson = json_encode(json_decode($jsonString, true), JSON_PRETTY_PRINT);
            // echo "<pre>$formattedJson</pre>"; // Makes it readable in HTML
    
            // Create a new RejectedHatch record
            $rejectedHatch = RejectedHatch::find($targetID);
            $rejectedHatch->ps_no = $validatedData['ps_no'];
            $rejectedHatch->production_date = $validatedData['production_date'];
            $rejectedHatch->set_eggs_qty = $validatedData['set_eggs_qty'];
            $rejectedHatch->incubator_no = $validatedData['incubator_no'];
            $rejectedHatch->hatcher_no = $validatedData['hatcher_no'];
    
            $rejectedHatch->rejected_hatch_data = $rejected_hatch_data;
    
            $rejectedHatch->pullout_date = $validatedData['pullout_date'];
            $rejectedHatch->hatch_date = $validatedData['hatch_date'];
            $rejectedHatch->rejected_total = $validatedData['rejected_total'];
            $rejectedHatch->rejected_total_percentage = $validatedData['rejected_total_prcnt'];
            
            $rejectedHatch->save();

            return redirect('/rejected-hatch')->with('success', 'Updated Successfully')->with('success_message', 'Rejected Hatch Entry Updated Successfully');
        }

    }

    public function generateReport($targetForm){

        if($targetForm == 'egg-collection') {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
        elseif($targetForm == 'egg-temperature') {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
        elseif($targetForm == 'rejected-hatch') {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }

    }
}
