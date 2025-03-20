<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Crypt;

use App\Models\MaintenanceValues;

class AdminController extends Controller
{

    function update_module_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'data_category' => 'required',
            'data_value' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->with('error', 'Please fill in all the required fields.');
        }

        $validatedData = $validator->validated();

        $adminInput = new MaintenanceValues();
        $adminInput->data_category = $validatedData['data_category'];
        $adminInput->data_value = $validatedData['data_value'];
        $adminInput->save();

        return response()->json([
            'success' => true,
            'message' => 'Maintenance Value Recorded Successfully'
        ]);

    }
    public function update_module_delete($id)
    {
        $record = MaintenanceValues::find($id);
    
        if (!$record) {
            return response()->json(['success' => false, 'message' => 'Record not found'], 404);
        }
    
        $record->delete();
    
        return response()->json(['success' => true, 'message' => 'Record deleted successfully']);
    }
}
