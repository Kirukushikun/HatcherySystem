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
use App\Models\RejectedPullets;
use App\Models\MaintenanceValues;

  
class EditController extends Controller
{
    public function edit_record_index($targetForm, $encryptedId){

        $targetID = Crypt::decrypt($encryptedId);

        if($targetForm == 'egg-collection'){
            $dataRecord = EggCollection::find($targetID);
        }
        elseif($targetForm == 'egg-temperature'){
            $dataRecord = EggTemperature::find($targetID);   
            $dataRecord->egg_temperature_data = json_decode($dataRecord->egg_temperature_data, true); // Decode JSON into array         
        }
        elseif($targetForm == 'rejected-hatch'){
            $dataRecord = RejectedHatch::find($targetID);
            $dataRecord->rejected_hatch_data = json_decode($dataRecord->rejected_hatch_data, true); // Decode JSON into array
        }
        elseif($targetForm == 'rejected-pullets'){
            $dataRecord = RejectedPullets::find($targetID);   
            $dataRecord->rejected_pullets_data = json_decode($dataRecord->rejected_pullets_data, true); // Decode JSON into array         
        }
        elseif($targetForm == 'maintenance-value'){
            $dataRecord = MaintenanceValues::find($targetID);
        }
        return view('hatchery.edit_module', [
            'targetForm' => $targetForm,
            'record' => $dataRecord
        ]);
    }

    public function edit_record_update(Request $request, $targetForm, $targetID){

        if($targetForm == 'egg-collection'){

            try {

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
    
                $beforeState = $eggCollection->toArray(); // Get the old values
                $beforeState = json_encode($beforeState);
    
                $eggCollection->ps_no = $validatedData['ps_no'];
                $eggCollection->house_no = $validatedData['house_no'];
                $eggCollection->production_date = $validatedData['production_date'];
                $eggCollection->collection_time = $validatedData['collection_time'];
                $eggCollection->collected_qty = $validatedData['collection_eggs_quantity'];
    
                $eggCollection->save();
    
                return redirect('/egg-collection')->with('success', 'Updated Successfully')->with('success_message', 'Egg Collection Entry Updated Successfully');

            } catch (\Exception $e) {

                // Log the error for debugging
                // Log::error('Error in edit_record_update(egg-collection): ' . $e->getMessage());
    
                return back()->with('error', 'Unexpected Error')->with('error_message', 'Something went wrong. Please try again.');
            }
           
        }
        
        elseif($targetForm == 'egg-temperature'){

            $validator = Validator::make($request->all(), [
                'temp_check_date' => 'required|date',
                'setting_date' => 'required|date',
                'hatch_date' => 'required|date',

                'temp_check_qty' => 'required|integer',

                'ovrl_above_temp_qty' => 'required|integer',
                'ovrl_above_temp_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
                'ovrl_below_temp_qty' => 'nullable|integer',
                'ovrl_below_temp_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',

                'left_ps_no' => 'required|string|max:255',
                'left_above_temp_qty' => 'nullable|integer',
                'left_above_temp_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
                'left_below_temp_qty' => 'nullable|integer',
                'left_below_temp_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
                'total_left_qty' => 'nullable|integer',

                'right_ps_no' => 'required|string|max:255',
                'right_above_temp_qty' => 'nullable|integer',
                'right_above_temp_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
                'right_below_temp_qty' => 'nullable|integer',
                'right_below_temp_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
                'total_right_qty' => 'nullable|integer',
            ]);
    
            if ($validator->fails()) {
                $errorMessages = $validator->errors();
                session()->flash('form_data', $request->only(['temp_check_date', 'setting_date', 'hatch_date', 'temp_check_qty', 'ovrl_above_temp_qty', 'left_ps_no', 'right_ps_no']));
    
                if ($errorMessages->hasAny(['temp_check_date', 'setting_date', 'hatch_date', 'temp_check_qty', 'ovrl_above_temp_qty', 'left_ps_no', 'right_ps_no'])) {
                    return back()->with('error', 'Saving Failed')->with('error_message', 'Please fill in all the required fields correctly.');
                }   
                if ($errorMessages->hasAny(['quantity', 'ovrl_above_temp_qty', 'ovrl_below_temp_qty', 'left_above_temp_qty', 'left_below_temp_qty', 'right_above_temp_qty', 'right_below_temp_qty', 'total_left_qty', 'total_right_qty'])) {
                    return back()->with('error', 'Invalid Quantity')->with('error_message', 'Quantity must be a valid integer.');
                }        
                if($errorMessages->hasAny(['ovrl_above_temp_prcnt', 'ovrl_below_temp_prcnt', 'left_above_temp_prcnt', 'left_below_temp_prcnt', 'right_above_temp_prcnt', 'right_below_temp_prcnt'])){
                    return back()->with('error', 'Invalid Decimal Format')->with('error_message', 'Input must be a valid decimal.');
                }
                if ($errorMessages->hasAny(['temp_check_date', 'setting_date', 'hatch_date'])) {
                    return back()->with('error', 'Invalid Date Format')->with('error_message', 'Please provide a valid date format (YYYY-MM-DD).');
                }            
            }
    
            $validatedData = $validator->validated();

            // Encode rejected hatch data as JSON
            $egg_temperature_data = json_encode([
                'left' => [
                    'ps_no' => (string) ($validatedData['left_ps_no'] ?? ''),
                    'above_temp_qty' => (int) ($validatedData['left_above_temp_qty'] ?? 0),
                    'above_temp_prcnt' => (float) ($validatedData['left_above_temp_prcnt'] ?? 0.0),
                    'below_temp_qty' => (int) ($validatedData['left_below_temp_qty'] ?? 0),
                    'below_temp_prcnt' => (float) ($validatedData['left_below_temp_prcnt'] ?? 0.0),
                    'total_qty' => (int) ($validatedData['total_left_qty'] ?? 0)
                ],
                'right' => [
                    'ps_no' => (string) ($validatedData['right_ps_no'] ?? ''),
                    'above_temp_qty' => (int) ($validatedData['right_above_temp_qty'] ?? 0),
                    'above_temp_prcnt' => (float) ($validatedData['right_above_temp_prcnt'] ?? 0.0),
                    'below_temp_qty' => (int) ($validatedData['right_below_temp_qty'] ?? 0),
                    'below_temp_prcnt' => (float) ($validatedData['right_below_temp_prcnt'] ?? 0.0),
                    'total_qty' => (int) ($validatedData['total_right_qty'] ?? 0)
                ],
            ], JSON_NUMERIC_CHECK);
    
            $eggTemperature = EggTemperature::find($targetID);

            $eggTemperature->temp_check_date = $validatedData['temp_check_date']; 
            $eggTemperature->setting_date = $validatedData['setting_date'];
            $eggTemperature->hatch_date = $validatedData['hatch_date'];

            $eggTemperature->temp_check_qty = $validatedData['temp_check_qty']; 
            $eggTemperature->ovrl_above_temp_qty = $validatedData['ovrl_above_temp_qty'];
            $eggTemperature->ovrl_above_temp_prcnt = $validatedData['ovrl_above_temp_prcnt'];
            $eggTemperature->ovrl_below_temp_qty = $validatedData['ovrl_below_temp_qty'];
            $eggTemperature->ovrl_below_temp_prcnt = $validatedData['ovrl_below_temp_prcnt'];

            $eggTemperature->egg_temperature_data = $egg_temperature_data;

            $eggTemperature->save();

            return redirect('/egg-temperature')->with('success', 'Updated Successfully')->with('success_message', 'Egg Temperature Entry Updated Successfully');
           
        }

        elseif($targetForm == 'rejected-hatch'){
            $validator = Validator::make($request->all(), [
                'ps_no' => 'required|string|max:255',
                'set_eggs_qty' => 'required|integer',
                'incubator_no' => 'required|array',
                'hatcher_no' => 'required|array',
            
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

                'production_date_from' => 'required|date',
                'production_date_to' => 'required|date',
                'hatch_date' => 'required|date',
                'qc_date' => 'required|date',
            
                'rejected_total' => 'required|integer',
                'rejected_total_prcnt' => 'required|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            ]);
    
            if($validator->fails()){
                $errorMessages = $validator->errors();
                session()->flash('form_data', $request->only(['ps_no', 'set_eggs_qty', 'incubator_no', 'hatcher_no', 'production_date_from', 'production_date_to', 'hatch_date', 'qc_date', 'rejected_total', 'rejected_total_prcnt']));
    
                if ($errorMessages->hasAny(['ps_no', 'set_eggs_qty', 'incubator_no', 'hatcher_no','production_date_from', 'production_date_to', 'qc_date', 'hatch_date', 'rejected_total', 'rejected_total_prcnt'])) {
                    return back()->with('error', 'Saving Failed')->with('error_message', 'Please fill in all the required fields correctly.');
                } 
                if($errorMessages->hasAny(['set_eggs_qty', 'unhatched', 'pips', 'rejected_chicks', 'dead_chicks', 'rotten', 'rejected_total'])){
                    return back()->with('error', 'Invalid Integer Format')->with('error_message', 'Input must be a valid integer.');
                }
                if($errorMessages->hasAny(['unhatched_prcnt', 'pips_prcnt', 'rejected_chicks_prcnt', 'dead_chicks_prcnt', 'rotten_prcnt', 'rejected_total_prcnt'])){
                    return back()->with('error', 'Invalid Decimal Format')->with('error_message', 'Input must be a valid decimal.');
                }
                if ($errorMessages->hasAny(['production_date_from', 'production_date_to', 'hatch_date', 'qc_date'])) {
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
    
            // Create a new RejectedHatch record
            $rejectedHatch = RejectedHatch::find($targetID);

            $rejectedHatch->ps_no = $validatedData['ps_no'];
            $rejectedHatch->set_eggs_qty = $validatedData['set_eggs_qty'];
            $rejectedHatch->incubator_no = $validatedData['incubator_no'];
            $rejectedHatch->hatcher_no = $validatedData['hatcher_no'];
    
            $rejectedHatch->rejected_hatch_data = $rejected_hatch_data;
            
            $rejectedHatch->production_date_from = $validatedData['production_date_from'];
            $rejectedHatch->production_date_to = $validatedData['production_date_to'];
            $rejectedHatch->hatch_date = $validatedData['hatch_date'];
            $rejectedHatch->qc_date = $validatedData['qc_date'];
            
            $rejectedHatch->rejected_total = $validatedData['rejected_total'];
            $rejectedHatch->rejected_total_percentage = $validatedData['rejected_total_prcnt'];
            
            $rejectedHatch->save();

            return redirect('/rejected-hatch')->with('success', 'Updated Successfully')->with('success_message', 'Rejected Hatch Entry Updated Successfully');
        }        

        elseif($targetForm == 'rejected-pullets'){

            $validator = Validator::make($request->all(), [
                'ps_no' => 'required|string|max:255',
                'set_eggs_qty' => 'required|integer',
                'incubator_no' => 'required|array',
                'hatcher_no' => 'required|array',
            
                'singkit_mata' => 'nullable|integer',
                'singkit_mata_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            
                'wala_mata' => 'nullable|integer',
                'wala_mata_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            
                'maliit_mata' => 'nullable|integer',
                'maliit_mata_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            
                'malaki_mata' => 'nullable|integer',
                'malaki_mata_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            
                'unhealed_navel' => 'nullable|integer',
                'unhealed_navel_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',

                'cross_beak' => 'nullable|integer',
                'cross_beak_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',

                'small_chick' => 'nullable|integer',
                'small_chick_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',

                'weak_chick' => 'nullable|integer',
                'weak_chick_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',

                'black_bottons' => 'nullable|integer',
                'black_bottons_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',

                'string_navel' => 'nullable|integer',
                'string_navel_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',

                'bloated' => 'nullable|integer',
                'bloated_prcnt' => 'nullable|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            
                'production_date_from' => 'required|date',
                'production_date_to' => 'required|date',
                'hatch_date' => 'required|date',
                'qc_date' => 'required|date',
            
                'rejected_total' => 'required|integer',
                'rejected_total_prcnt' => 'required|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            ]);

            // if($validator->fails()){
            //     $errorMessages = $validator->errors();
            //     session()->flash('form_data', $request->only(['ps_no', 'production_date', 'set_eggs_qty', 'incubator_no', 'hatcher_no', 'pullout_date', 'hatch_date', 'qc_date', 'rejected_total', 'rejected_total_prcnt']));

            //     if ($errorMessages->hasAny(['ps_no', 'production_date', 'set_eggs_qty', 'incubator_no', 'hatcher_no', 'pullout_date', 'hatch_date', 'qc_date', 'rejected_total', 'rejected_total_prcnt'])) {
            //         return back()->with('error', 'Saving Failed')->with('error_message', 'Please fill in all the required fields correctly.');
            //     } 
            //     if($errorMessages->hasAny(['set_eggs_qty', 'singkit_mata', 'wala_mata', 'maliit_mata', 'malaki_mata', 'unhealed_navel', 'cross_beak', 'small_chick', 'weak_chick', 'black_bottons', 'string_navel', 'bloated', 'rejected_total'])){
            //         return back()->with('error', 'Invalid Integer Format')->with('error_message', 'Input must be a valid integer.');
            //     }
            //     if($errorMessages->hasAny(['singkit_mata_prcnt', 'wala_mata_prcnt', 'maliit_mata_prcnt', 'malaki_mata_prcnt', 'unhealed_navel_prcnt', 'cross_beak_prcnt', 'small_chick_prct', 'weak_chick_prct', 'black_bottons_prcnt', 'string_navel_prcnt', 'bloated_prcnt'])){
            //         return back()->with('error', 'Invalid Decimal Format')->with('error_message', 'Input must be a valid decimal.');
            //     }
            //     if ($errorMessages->hasAny(['production_date', 'pullout_date', 'hatch_date', 'qc_date'])) {
            //         return back()->with('error', 'Invalid Date Format')->with('error_message', 'Please provide a valid date format (YYYY-MM-DD).');
            //     }  
            // }      
    
            $validatedData = $validator->validated();

            // Encode rejected hatch data as JSON
            $rejected_pullets_data = json_encode([
                'singkit_mata' => [
                    'qty' => (int) ($validatedData['singkit_mata'] ?? 0),
                    'percentage' => (float) ($validatedData['singkit_mata_prcnt'] ?? 0.0)
                ],
                'wala_mata' => [
                    'qty' => (int) ($validatedData['wala_mata'] ?? 0),
                    'percentage' => (float) ($validatedData['wala_mata_prcnt'] ?? 0.0)
                ],
                'maliit_mata' => [
                    'qty' => (int) ($validatedData['maliit_mata'] ?? 0),
                    'percentage' => (float) ($validatedData['maliit_mata_prcnt'] ?? 0.0)
                ],
                'malaki_mata' => [
                    'qty' => (int) ($validatedData['malaki_mata'] ?? 0),
                    'percentage' => (float) ($validatedData['malaki_mata_prcnt'] ?? 0.0)
                ],
                'unhealed_navel' => [
                    'qty' => (int) ($validatedData['unhealed_navel'] ?? 0),
                    'percentage' => (float) ($validatedData['unhealed_navel_prcnt'] ?? 0.0)
                ],
                'cross_beak' => [
                    'qty' => (int) ($validatedData['cross_beak'] ?? 0),
                    'percentage' => (float) ($validatedData['cross_beak_prcnt'] ?? 0.0)
                ],
                'small_chick' => [
                    'qty' => (int) ($validatedData['small_chick'] ?? 0),
                    'percentage' => (float) ($validatedData['small_chick_prcnt'] ?? 0.0)
                ],
                'weak_chick' => [
                    'qty' => (int) ($validatedData['weak_chick'] ?? 0),
                    'percentage' => (float) ($validatedData['weak_chick_prcnt'] ?? 0.0)
                ],
                'black_bottons' => [
                    'qty' => (int) ($validatedData['black_bottons'] ?? 0),
                    'percentage' => (float) ($validatedData['black_bottons_prcnt'] ?? 0.0)
                ],
                'string_navel' => [
                    'qty' => (int) ($validatedData['string_navel'] ?? 0),
                    'percentage' => (float) ($validatedData['string_navel_prcnt'] ?? 0.0)
                ],
                'bloated' => [
                    'qty' => (int) ($validatedData['bloated'] ?? 0),
                    'percentage' => (float) ($validatedData['bloated_prcnt'] ?? 0.0)
                ]
            ], JSON_NUMERIC_CHECK);   

            $rejectedPullets = RejectedPullets::find($targetID);

            $rejectedPullets->ps_no = $validatedData['ps_no'];
            $rejectedPullets->set_eggs_qty = $validatedData['set_eggs_qty'];
            $rejectedPullets->incubator_no = $validatedData['incubator_no'];
            $rejectedPullets->hatcher_no = $validatedData['hatcher_no'];

            $rejectedPullets->rejected_pullets_data = $rejected_pullets_data;

            $rejectedPullets->production_date_from = $validatedData['production_date_from'];
            $rejectedPullets->production_date_to = $validatedData['production_date_to'];
            $rejectedPullets->hatch_date = $validatedData['hatch_date'];
            $rejectedPullets->qc_date = $validatedData['qc_date'];
            
            $rejectedPullets->rejected_total = $validatedData['rejected_total'];
            $rejectedPullets->rejected_total_percentage = $validatedData['rejected_total_prcnt'];
            
            $rejectedPullets->save();

            return redirect('/rejected-pullets')->with('success', 'Updated Successfully')->with('success_message', 'Rejected Pullets Entry Updated Successfully');

        }

        elseif($targetForm == 'maintenance-value'){
            try{

                $validator = Validator::make($request->all(), [
                    'data_category' => 'required',
                    'data_value' => 'required',
                ]);
        
                if ($validator->fails()) {
                    return back()->with('error', 'Please fill in all the required fields.');
                }
        
                $validatedData = $validator->validated();
        
                $adminInput = MaintenanceValues::find($targetID);
                $adminInput->data_category = $validatedData['data_category'];
                $adminInput->data_value = $validatedData['data_value'];
                $adminInput->save();
        
                return redirect('/admin')->with('success', 'Updated Successfully')->with('success_message', 'Maintenance Value Updated Successfully');
            }catch (\Exception $e) {

                // Log the error for debugging
                // Log::error('Error in edit_record_update(maintenance-value): ' . $e->getMessage());
    
                return back()->with('error', 'Unexpected Error')->with('error_message', 'Something went wrong. Please try again.');
            }
       
        }

    }

    // public function logAction($action, $currentState, $beforeState = null, $targetForm){
    //     if ($targetForm == 'egg-collection') {
    //         $messages = [
    //             'update' => 'Egg Collection Record Updated',
    //         ];
    //         $log_entry = [
    //             $messages[$action] ?? 'Egg Collection Record Modified',
    //             'egg_collection',
    //             $beforeState, // Stores previous state before the action
    //             $currentState, // Stores the new state after the action
    //         ];
    //         AC::logEntry($log_entry);
    //     }

    //     elseif ($targetForm == 'egg-temperature') {
    //         $messages = [
    //             'update' => 'Egg Temperature Record Updated',
    //         ];
    //         $log_entry = [
    //             $messages[$action] ?? 'Egg Temperature Record Modified',
    //             'egg_temperature',
    //             $beforeState, // Stores previous state before the action
    //             $currentState, // Stores the new state after the action
    //         ];
    //         AC::logEntry($log_entry);
    //     }

    //     elseif ($targetForm == 'rejected-hatch') {
    //         $messages = [
    //             'update' => 'Rejected Hatch Record Updated',
    //         ];
    //         $log_entry = [
    //             $messages[$action] ?? 'Rejected Hatch Record Modified',
    //             'rejected_hatch',
    //             $beforeState, // Stores previous state before the action
    //             $currentState, // Stores the new state after the action
    //         ];
    //         AC::logEntry($log_entry);
    //     }
    
    //     elseif ($targetForm == 'rejected-pullets') {
    //         $messages = [
    //             'update' => 'Rejected Pullets Record Updated',
    //         ];
    //         $log_entry = [
    //             $messages[$action] ?? 'Rejected Pullets Record Modified',
    //             'rejected_pullets',
    //             $beforeState, // Stores previous state before the action
    //             $currentState, // Stores the new state after the action
    //         ];
    //         AC::logEntry($log_entry);
    //     }
    // }
}