<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AuditController as AC;

use Illuminate\Support\Facades\Crypt;

use App\Models\EggCollection;

class EggCollectionController extends Controller
{
    function egg_collection_index() {
        $egg_collections = EggCollection::where('is_deleted', false)->count();
        return view('hatchery.egg_collection', ['egg_collections' => $egg_collections]);
    }

    function egg_collection_store(Request $request) {
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
    
            $eggCollection = new EggCollection();
            $eggCollection->ps_no = $validatedData['ps_no'];
            $eggCollection->house_no = $validatedData['house_no']; 
            $eggCollection->production_date = $validatedData['production_date'];
            $eggCollection->collection_time = $validatedData['collection_time'];
            $eggCollection->collected_qty = $validatedData['collection_eggs_quantity'];
            $eggCollection->save();
    
            // Log the action
            $this->logEggCollectionAction('store', $eggCollection, null);
    
            return response()->json([
                'success' => true,
                'message' => 'Egg Collection Entry Recorded Successfully'
            ]);
    
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in egg_collection_store: ' . $e->getMessage());
    
            return back()->with('error', 'Unexpected Error')->with('error_message', 'Something went wrong. Please try again.');
        }
    }
    

    public function egg_collection_delete(Request $request, $targetID){
        try{

            $eggCollection = EggCollection::find($targetID);
    
            if (!$eggCollection) {
                return response()->json(['success' => false, 'message' => 'Record not found'], 404);
            }
    
            // Capture before state (store relevant attributes)
            $beforeState = $eggCollection->toJson();
        
            $eggCollection->is_deleted = true;
            $eggCollection->save();
    
            // Log the action with before state
            $this->logEggCollectionAction('delete', $eggCollection, $beforeState);
        
            return response()->json(['success' => true, 'message' => 'Egg Collection Entry Deleted Successfully']);

        } catch (\Exception $e) {

            // Log the error for debugging
            Log::error('Error in egg_collection_delete: ' . $e->getMessage());

            return back()->with('error', 'Unexpected Error')->with('error_message', 'Something went wrong. Please try again.');
        }
    }
    public function driver_collection_store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'ps_no' => 'required|string|max:255',
                'house_no' => 'required|string|max:255',
                'production_date' => 'required|date',
                'collection_time' => 'required|date_format:H:i',
                'collection_eggs_quantity' => 'required|integer',
                'driver' => 'required|string|max:255',
            ]);
    
            if ($validator->fails()) {
                $errorMessages = $validator->errors();
                session()->flash('form_data', $request->only(['ps_no', 'house_no', 'production_date', 'collection_time', 'collection_eggs_quantity', 'driver']));
    
                if ($errorMessages->hasAny(['ps_no', 'house_no', 'production_date', 'collection_time', 'driver'])) {
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
    
            $eggCollection = new EggCollection();
            $eggCollection->ps_no = $validatedData['ps_no'];
            $eggCollection->house_no = $validatedData['house_no']; 
            $eggCollection->production_date = $validatedData['production_date'];
            $eggCollection->collection_time = $validatedData['collection_time'];
            $eggCollection->collected_qty = $validatedData['collection_eggs_quantity'];
            $eggCollection->driver = $validatedData['driver'];
            $eggCollection->save();
    
            // // Log the action
            // $this->logEggCollectionAction('store', $eggCollection, null);
    
            return response()->json([
                'success' => true,
                'message' => 'Egg Collection Entry Recorded Successfully'
            ]);
    
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in driver_collection_store: ' . $e->getMessage());
    
            return back()->with('error', 'Unexpected Error')->with('error_message', 'Something went wrong. Please try again.');
        }
    }

    public function logEggCollectionAction($action, $currentState, $beforeState = null, $entryVia)
    {
        try{
            $messages = [
            'store' => 'Egg Collection Record Added',
            'update' => 'Egg Collection Record Updated',
            'delete' => 'Egg Collection Record Deleted',
            ];
            $log_entry = [
                $messages[$action] ?? 'Egg Collection Record Modified',
                'egg_collection',
                $beforeState, // Stores previous state before the action
                $currentState, // Stores the new state after the action
            ];
            AC::logEntry($log_entry);

        }catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error in logEggCollectionAction: ' . $e->getMessage());
        }
        
    }

}

