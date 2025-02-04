<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

        EggTemperature::create([
            'ps_no' => $validatedData['ps_no'],
            'setting_date' => $validatedData['setting_date'],
            'incubator' => $validatedData['incubator_no'],
            'location' => $validatedData['location'],
            'temperature' => $validatedData['temperature'],
            'temperature_check_date' => $validatedData['temp_check_date'],
            'quantity' => $validatedData['quantity'],
        ]);

        

        // return back()->with('success', 'Saved Successfully')->with('success_message', 'Egg Temperature Entry Recorded Successfully');
        return redirect('/egg-temperature')->with('success', 'Saved Successfully')->with('success_message', 'Egg Temperature Entry Recorded Successfully');
    }

}
