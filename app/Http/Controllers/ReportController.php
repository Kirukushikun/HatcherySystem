<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function generateReport($targetForm){

        if($targetForm == 'egg-collection') 
        {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
        elseif($targetForm == 'egg-temperature') 
        {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
        elseif($targetForm == 'rejected-hatch') 
        {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
        elseif($targetForm == 'rejected-pullets') 
        {    
            return view('hatchery.report_module', ['targetForm' => $targetForm]);
        }
  
    }
}
