<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EggTemperature;

class EggTemperatureController extends Controller
{
    function egg_temperature_index(){
        return view('hatchery.egg_temperature');
    }

    function egg_temperature_store(Request $request){
        $validatedData = $request->validate([
            'ps_no' => 'required|string|max:255',
            'setting_date' => 'required|date',
            'incubator_no' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'temp_check_date' => 'required|date',
            'temperature' => 'required|string|max:255',
            'quantity' => 'required|integer',
        ]);

        EggTemperature::create([
            'ps_no' => $validatedData['ps_no'],
            'setting_date' => $validatedData['setting_date'],
            'incubator' => $validatedData['incubator_no'],
            'location' => $validatedData['location'],

            'temperature' => $validatedData['temperature'],
            'temperature_check_date' => $validatedData['temp_check_date'],            
            'quantity' => $validatedData['quantity'],
        ]);

        return back()->with('success', 'Egg Temperature Recorded Successfully');
    }
}
