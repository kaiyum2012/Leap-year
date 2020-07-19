<?php
namespace App\Helper;

class Date {
    public $date;

    public function __construct($str)
    {
        if($str == null)
            $this->date = (object) getDate();
        else
            $this->date = (object) getDate(strtotime($str));
    }

    function getYear()
    {
        return $this->date->year;
    }

    function getMonth(){
        return $this->date->mon;
    }

    function getCurrentMonthDay(){
        return $this->date->mday;
    }

    function getCurrentYearDay(){
        return $this->date->yday;
    }

    public function isLeapYear()
    {
        $year = $this->getYear();
        return ((($year % 4) == 0) && ((($year % 100) != 0) || (($year %400) == 0)));
    }

    public function getYearEndDate(){
        return ($this->getYear() . '-12-31');
    }
}