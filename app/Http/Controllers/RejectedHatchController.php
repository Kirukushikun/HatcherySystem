<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\RejectedHatch;

class RejectedHatchController extends Controller
{
    function rejected_hatch_index(){
        return view('hatchery.rejected_hatch');
    }

    function rejected_hatch_store(Request $request){
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
        $rejectedHatch = new RejectedHatch();
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

        // Log the action
        // $this->logCollectionAction('store', $rejectedHatch, null);

        return response()->json([
            'success' => true,
            'message' => 'Rejected Hatch Entry Recorded Successfully'
        ]);

    }

    function rejected_hatch_delete($targetID){        
        $rejectedHatch = RejectedHatch::find($targetID); // Find the RejectedHatch record by ID

        if (!$rejectedHatch) {
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }
        // Capture before state (store relevant attributes)
        $beforeState = $rejectedHatch->toJson();

        $rejectedHatch->is_deleted = true;
        $rejectedHatch->save();

        // Log the action with before state
        // $this->logCollectionAction('delete', $rejectedHatch, $beforeState);
    
    
        return response()->json(['success' => true, 'message' => 'Rejected Hatch Entry Deleted Successfully']);    
    }   

    // public function logCollectionAction($action, $currentState, $beforeState = null)
    // {
    //     $messages = [
    //         'store' => 'Rejected Hatch Record Added',
    //         'delete' => 'Rejected Hatch Record Deleted',
    //     ];
    //     $log_entry = [
    //         $messages[$action] ?? 'Rejected Hatch Record Modified',
    //         'rejected_hatch',
    //         $beforeState, // Stores previous state before the action
    //         $currentState, // Stores the new state after the action
    //     ];
    //     AC::logEntry($log_entry);
    // }
}
