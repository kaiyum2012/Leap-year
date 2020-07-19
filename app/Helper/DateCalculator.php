<?php

namespace App\Helper;
use Carbon\Carbon;

class DateCalculator {
    public Date $fromDate;
    public Date $toDate;

    function  __construct(Date $from,Date $to){
       $this->fromDate = $from;
       $this->toDate = $to;
    }

/***
 * Algo:
 * calDiffTotalDays() -> return no of day diff between from and to dates. 
 * from and to date order dont matters.
 * if from and To date years are the same
 *      get elapsed days in year, followed by difference 
 * else 
 *     1.  get elapsed day for - From date to last day of from day
 *     2.  while (from date year --> to date year)
 *         {
 *              get days in a year - > {if leap year -> days = 366 else 365}
 *         }
 *     3. get elapsed day in to date year 
 *     4. Add days from step 1,2 and 3.
 * 
 */
    public function calcDiffTotalDays()
    {
        $days = 0;
        if($this->fromDate->getYear() ==  $this->toDate->getYear()){
            $start = $this->fromDate->getCurrentYearDay();
            $end = $this->toDate->getCurrentYearDay();
            $days = abs( $end - $start);
        }else{
            // Step 1
            $temp = new Date ($this->fromDate->getYearEndDate());
            // dd($temp);
            $days = $days + ($temp->getCurrentYearDay() - $this->fromDate->getCurrentYearDay());

            $year = $temp->getYear() + 1;
            // Step 2
            while($year < $this->toDate->getYear()){
                if ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0))){
                  //  echo "Leap year -" . $year . "<br/>";
                  //  echo "for year :". $y . " -- 366<br/>";
                    $days = $days + 366;
                }else{
                   // echo "for year :". $y . " -- 365<br/>";
                    $days = $days + 365;
                }
                $year++;
            }
            // Step 3: Current year days add.
            $days += $this->toDate->getCurrentYearDay();  
        }

        return $days;
    }

    // TODOO:: Calculate no of months between From and To date
    public function calcDiffTotalMonths(){

    }
    
    // TODOO:: Calculate no of years between From and To date
    public function calcDiffTotalYears(){

    }

    // TODO:: Calculate No of leap year in between From and To date
    public function calcNoOfLeapYears()
    {

    }
}
