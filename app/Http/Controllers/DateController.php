<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DateDiffCalcRequest;
use Carbon\Carbon;
use App\Helper\DateCalculator;
use App\Helper\Date;
use App\Model\DateHistory;
// use Session;

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
            $result->error = $validator->errors()->toArray();
            // Session::flash('error', $result->error);
        }else{
            $start = new Date($req->sDate);
            $end = new Date($req->eDate);
        
            $x = new DateCalculator($start,$end);
            
            // PHP 7+
            $result = new \stdClass;
            $result->success = true;
            $result->days = $x->calcDiffTotalDays();

            // DONE:: Persist record in DB
            $record = new DateHistory();
            $record->start_date = $req->sDate;
            $record->end_date = $req->eDate;
            $record->days = $result->days;

            $record->save();

            $result->startDate = array(
                'start_date' => $req->sDate,
                'leap_year' => $start->isLeapYear()
            );
            $result->endDate = array(
                'end_date' => $req->eDate,
                'leap_year' => $end->isLeapYear()
            );
        }
        
        return response(json_encode($result));
    }

    public function History(){

        $records = DateHistory::orderBy('created_at','desc')->get();
       
        return response(json_encode($records));
    }
}
 