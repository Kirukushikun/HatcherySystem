<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AuditController as AC;

use Illuminate\Support\Facades\Crypt;

use App\Models\RejectedPullets;

class RejectedPulletsController extends Controller
{
    function rejected_pullets_index() {
        return view('hatchery.rejected_pullets');
    }

    function rejected_pullets_store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
            'ps_no' => 'required|string|max:255',
            'production_date' => 'required|date',
            'set_eggs_qty' => 'required|integer',
            'incubator_no' => 'required|string|max:255',
            'hatcher_no' => 'required|string|max:255',
        
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
        
            'pullout_date' => 'required|date',
            'hatch_date' => 'required|date',
            'qc_date' => 'required|date',
        
            'rejected_total' => 'required|integer',
            'rejected_total_prcnt' => 'required|numeric|min:0|max:100|regex:/^\d{1,3}(\.\d{1})?$/',
            ]);

            if($validator->fails()){
                $errorMessages = $validator->errors();
                session()->flash('form_data', $request->only(['ps_no', 'production_date', 'set_eggs_qty', 'incubator_no', 'hatcher_no', 'pullout_date', 'hatch_date', 'qc_date', 'rejected_total', 'rejected_total_prcnt']));

                if ($errorMessages->hasAny(['ps_no', 'production_date', 'set_eggs_qty', 'incubator_no', 'hatcher_no', 'pullout_date', 'hatch_date', 'qc_date', 'rejected_total', 'rejected_total_prcnt'])) {
                    return back()->with('error', 'Saving Failed')->with('error_message', 'Please fill in all the required fields correctly.');
                } 
                if($errorMessages->hasAny(['set_eggs_qty', 'singkit_mata', 'wala_mata', 'maliit_mata', 'malaki_mata', 'unhealed_navel', 'cross_beak', 'small_chick', 'weak_chick', 'black_bottons', 'string_navel', 'bloated', 'rejected_total'])){
                    return back()->with('error', 'Invalid Integer Format')->with('error_message', 'Input must be a valid integer.');
                }
                if($errorMessages->hasAny(['singkit_mata_prcnt', 'wala_mata_prcnt', 'maliit_mata_prcnt', 'malaki_mata_prcnt', 'unhealed_navel_prcnt', 'cross_beak_prcnt', 'small_chick_prct', 'weak_chick_prct', 'black_bottons_prcnt', 'string_navel_prcnt', 'bloated_prcnt'])){
                    return back()->with('error', 'Invalid Decimal Format')->with('error_message', 'Input must be a valid decimal.');
                }
                if ($errorMessages->hasAny(['production_date', 'pullout_date', 'hatch_date', 'qc_date'])) {
                    return back()->with('error', 'Invalid Date Format')->with('error_message', 'Please provide a valid date format (YYYY-MM-DD).');
                }  
            }        

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

            // //Debugging
            // $formattedJson = json_encode(json_decode($jsonString, true), JSON_PRETTY_PRINT);
            // echo "<pre>$formattedJson</pre>"; // Makes it readable in HTML

            // Create a new RejectedPullets record
            $rejectedPullets = new RejectedPullets();
            $rejectedPullets->ps_no = $validatedData['ps_no'];
            $rejectedPullets->production_date = $validatedData['production_date'];
            $rejectedPullets->set_eggs_qty = $validatedData['set_eggs_qty'];
            $rejectedPullets->incubator_no = $validatedData['incubator_no'];
            $rejectedPullets->hatcher_no = $validatedData['hatcher_no'];

            $rejectedPullets->rejected_pullets_data = $rejected_pullets_data;

            $rejectedPullets->pullout_date = $validatedData['pullout_date'];
            $rejectedPullets->hatch_date = $validatedData['hatch_date'];
            $rejectedPullets->qc_date = $validatedData['qc_date'];
            $rejectedPullets->rejected_total = $validatedData['rejected_total'];
            $rejectedPullets->rejected_total_percentage = $validatedData['rejected_total_prcnt'];
            
            $rejectedPullets->save();

            // Log the action
            // $this->logCollectionAction('store', $rejectedPullets, null);

            return response()->json([
                'success' => true,
                'message' => 'Rejected Pullets Entry Recorded Successfully'
            ]);
        }catch (\Exception $e) {

            // Log the error for debugging
            Log::error('Error in rejected_pullets_store: ' . $e->getMessage());

            return back()->with('error', 'Unexpected Error')->with('error_message', 'Something went wrong. Please try again.');
        }

    }

    public function rejected_pullets_delete(Request $request, $targetID){
        try
        {
            $rejectedPullets = RejectedPullets::find($targetID);
    
            if (!$rejectedPullets) {
                return response()->json(['success' => false, 'message' => 'Record not found'], 404);
            }

            // Capture before state (store relevant attributes)
            $beforeState = $rejectedPullets->toJson();
        
            $rejectedPullets->is_deleted = true;
            $rejectedPullets->save();
        
            // Log the action with before state
            // $this->logCollectionAction('delete', $rejectedPullets, $beforeState);
        
            return response()->json(['success' => true, 'message' => 'Rejected Pullets Entry Deleted Successfully']);
        }catch (\Exception $e) {

            // Log the error for debugging
            Log::error('Error in rejected_pullets_delete: ' . $e->getMessage());

            return back()->with('error', 'Unexpected Error')->with('error_message', 'Something went wrong. Please try again.');
        }
    }

    // public function logCollectionAction($action, $currentState, $beforeState = null)
    // {
    //     $messages = [
    //         'store' => 'Rejected Pullets Record Added',
    //         'delete' => 'Rejected Pullets Record Deleted',
    //     ];
    //     $log_entry = [
    //         $messages[$action] ?? 'Rejected Pullets Record Modified',
    //         'rejected_pullets',
    //         $beforeState, // Stores previous state before the action
    //         $currentState, // Stores the new state after the action
    //     ];
    //     AC::logEntry($log_entry);
    // }
}
