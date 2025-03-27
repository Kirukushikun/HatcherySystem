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
                'ps_no' => 'required|string|max:255',
                'setting_date' => 'required|date',
                'incubator_no' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'temp_check_date' => 'required|date',
                'temperature' => 'required|string|max:255',
                'quantity' => 'required|integer',
            ]);
    
    
            if ($validator->fails()) {
                $errorMessages = $validator->errors();
                session()->flash('form_data', $request->only(['ps_no', 'setting_date', 'incubator_no', 'location', 'temp_check_date', 'temperature', 'quantity']));
    
                if ($errorMessages->hasAny(['ps_no', 'setting_date', 'incubator_no', 'location', 'temp_check_date', 'temperature', 'quantity'])) {
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
    
            $eggTemperature = new EggTemperature();
            $eggTemperature->ps_no = $validatedData['ps_no'];
            $eggTemperature->setting_date = $validatedData['setting_date']; 
            $eggTemperature->incubator_no = $validatedData['incubator_no'];
            $eggTemperature->location = $validatedData['location'];
            $eggTemperature->temperature = $validatedData['temperature'];
            $eggTemperature->temperature_check_date = $validatedData['temp_check_date'];
            $eggTemperature->quantity = $validatedData['quantity'];
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


    public function logEggTemperatureAction($action, $currentState, $beforeState = null)
    {
        try{
            $messages = [
            'store' => 'Egg Shell Temperature Record Added',
            'update' => 'Egg Shell Temperature Record Updated',
            'delete' => 'Egg Shell Temperature Record Deleted',
            ];

            $log_entry = [
                $messages[$action] ?? 'Egg Shell Temperature Record Modified',
                'egg_temperature',
                $beforeState, // Stores previous state before the action
                $currentState, // Stores the new state after the action
            ];

            AC::logEntry($log_entry);
        }catch (\Exception $e) {
    
            // Log the error for debugging
            Log::error('Error in logEggTemperatureAction: ' . $e->getMessage());

            return back()->with('error', 'Unexpected Error')->with('error_message', 'Something went wrong. Please try again.');
        }
    }
}
