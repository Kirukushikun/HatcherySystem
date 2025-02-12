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

        $eggTemperature = new EggTemperature();
        $eggTemperature->ps_no = $validatedData['ps_no'];
        $eggTemperature->setting_date = $validatedData['setting_date']; 
        $eggTemperature->incubator = $validatedData['incubator'];
        $eggTemperature->location = $validatedData['location'];
        $eggTemperature->temperature = $validatedData['temperature'];
        $eggTemperature->temperature_check_date = $validatedData['temp_check_date'];
        $eggTemperature->quantity = $validatedData['quantity'];
        $eggTemperature->save();

        //Audit Trails
        $log_entry = [
            'Egg Shell Temperature Entry',
            'egg_temperature',
            '',
            $eggTemperature,
        ];
        AC::logEntry($log_entry);

        // return back()->with('success', 'Saved Successfully')->with('success_message', 'Egg Temperature Entry Recorded Successfully');
        return redirect('/egg-temperature')->with('success', 'Saved Successfully')->with('success_message', 'Egg Temperature Entry Recorded Successfully');
    }

    public function egg_temperature_delete(Request $request, $targetID)
    {
        $eggTemperature = EggTemperature::find($targetID);
    
        if (!$eggTemperature) {
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }
    
        $eggTemperature->is_deleted = true;
        $eggTemperature->save();
    
        return response()->json(['success' => true, 'message' => 'Egg Temperature Entry Deleted Successfully']);
    }

    public function edit_record_index($targetForm, $encryptedId){

        $targetID = Crypt::decrypt($encryptedId);

        if($targetForm == 'egg-temperature'){
            $dataRecord = EggTemperature::find($targetID);            
        }

        return view('hatchery.edit_module', [
            'targetForm' => $targetForm,
            'record' => $dataRecord
        ]);
    }

    public function edit_record_update(Request $request, $targetForm, $targetID){
        if($targetForm == 'egg-temperature'){
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
        }

        return redirect('/egg-temperature')->with('success', 'Updated Successfully')->with('success_message', 'Egg Temperature Entry Updated Successfully');
    }

}
