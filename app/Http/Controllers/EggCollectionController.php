<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Crypt;

use App\Models\EggCollection;

class EggCollectionController extends Controller
{
    function egg_collection_index() {
        return view('hatchery.egg_collection');
    }

    function egg_collection_store(Request $request) {
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


        EggCollection::create([
            'ps_no' => $validatedData['ps_no'],
            'house_no' => $validatedData['house_no'],
            'production_date' => $validatedData['production_date'],
            'collection_time' => $validatedData['collection_time'],
            'collected_qty' => $validatedData['collection_eggs_quantity'],
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Egg Collection Entry Recorded Successfully'
        ]);

    }

    public function egg_collection_delete(Request $request, $targetID)
    {
        $eggCollection = EggCollection::find($targetID);
    
        if (!$eggCollection) {
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }
    
        $eggCollection->is_deleted = true;
        $eggCollection->save();
    
        return response()->json(['success' => true, 'message' => 'Egg Collection Entry Deleted Successfully']);
    }

    public function edit_record_index($targetForm, $encryptedId){

        $targetID = Crypt::decrypt($encryptedId);
        if($targetForm == 'egg-collection'){
            $dataRecord = EggCollection::find($targetID);            
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
        }
        return redirect('/egg-collection')->with('success', 'Updated Successfully')->with('success_message', 'Egg Collection Entry Updated Successfully');
    }
}

