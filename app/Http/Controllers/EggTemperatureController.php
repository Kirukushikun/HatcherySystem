<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AuditController as AC;

use Illuminate\Support\Facades\Crypt;

use App\Models\EggTemperature;

class EggTemperatureController extends Controller
{
    function egg_temperature_index(){
        return view('hatchery.egg_temperature');
    }
    
    function egg_temperature_store(Request $request){
        try{

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
    
            $eggTemperature = new EggTemperature();
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
    
            //Audit Trails
            // $this->logEggTemperatureAction('store', $eggTemperature, null);
    
            return response()->json([
                'success' => true,
                'message' => 'Egg Temperature Entry Recorded Successfully'
            ]);
        }catch (\Exception $e) {

            // Log the error for debugging
            Log::error('Error in egg_temperature_store: ' . $e->getMessage());

            return back()->with('error', 'Unexpected Error')->with('error_message', 'Something went wrong. Please try again.');
        }
       
    }

    public function egg_temperature_delete(Request $request, $targetID)
    {
        try{

            $eggTemperature = EggTemperature::find($targetID);
        
            if (!$eggTemperature) {
                return response()->json(['success' => false, 'message' => 'Record not found'], 404);
            }

            // Capture before state (store relevant attributes)
            $beforeState = $eggTemperature->toJson();
        
            $eggTemperature->is_deleted = true;
            $eggTemperature->save();

            // Log the action with before state
            // $this->logEggTemperatureAction('delete', $eggTemperature, $beforeState);
        
            return response()->json(['success' => true, 'message' => 'Egg Temperature Entry Deleted Successfully']);

        }
        catch (\Exception $e) {

            // Log the error for debugging
            Log::error('Error in egg_temperature_delete: ' . $e->getMessage());

            return back()->with('error', 'Unexpected Error')->with('error_message', 'Something went wrong. Please try again.');
        }
        
    }


    // public function logEggTemperatureAction($action, $currentState, $beforeState = null)
    // {
    //     $messages = [
    //         'store' => 'Egg Shell Temperature Record Added',
    //         'update' => 'Egg Shell Temperature Record Updated',
    //         'delete' => 'Egg Shell Temperature Record Deleted',
    //     ];

    //     $log_entry = [
    //         $messages[$action] ?? 'Egg Shell Temperature Record Modified',
    //         'egg_temperature',
    //         $beforeState, // Stores previous state before the action
    //         $currentState, // Stores the new state after the action
    //     ];

    //     AC::logEntry($log_entry);
    // }



}
