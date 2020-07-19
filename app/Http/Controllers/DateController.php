<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DateDiffCalcRequest;
use Carbon\Carbon;
use App\Helper\DateCalculator;
use App\Helper\Date;
class DateController extends Controller
{
    public function Calculate(DateDiffCalcRequest $req)
    {
        // Method 1 : using Validator Class
        // $validator =  \Validator::Make($req->all(),[
        //     'sDate' =>'required|date',
        //     'eDate'=>'required|date'
        // ]);
        // if($validator->fails())

        // Method 2 : using Custom Request
        if(!$req->validated())
        {
            $result = new \stdClass;
            $result->success = false;
            $result->error = $validator->errors();
        }else{
            $start = new Date($req->sDate);
            $end = new Date($req->eDate);
        
            $x = new DateCalculator($start,$end);
            
            // PHP 7+
            $result = new \stdClass;
            $result->success = true;
            $result->days = $x->calcDiffTotalDays();
        }
        
        return response(json_encode($result));
    }
}
 