<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\EggCollection;

class EggCollectionController extends Controller
{
    function egg_collection_index() {
        return view('hatchery.egg_collection');
    }

    function egg_collection_store(Request $request) {
        $validateData = $request->validate([
            'ps_no' => 'required|string|max:255',
            'house_no' => 'required|string|max:255',
            'production_date' => 'required|date',
            'collection_time' => 'required|date_format:H:i',
            'collection_eggs_quantity' => 'required|integer',
        ]);

        EggCollection::create([
            'ps_no' => $validateData['ps_no'],
            'house_no' => $validateData['house_no'],
            'production_date' => $validateData['production_date'],
            'collection_time' => $validateData['collection_time'],
            'collected_qty' => $validateData['collection_eggs_quantity'],
        ]);
        return back();
    }

}

