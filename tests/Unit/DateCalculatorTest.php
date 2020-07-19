<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helper\DateCalculator;
use App\Helper\Date;

class DateCalculatorTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $testData = array(
            // Some Days
            ['sDate' =>'13-06-1992','eDate' =>'19-07-2020','days'=>10262],
            // sDate = eDate
            ['sDate' =>'19-07-2020','eDate' =>'19-07-2020','days'=>0],
            // 1 Day 
            ['sDate' =>'18-07-2020','eDate' =>'19-07-2020','days'=>1],
            // sDate > eDate
            ['sDate' =>'31-12-2020','eDate' =>'19-07-2020','days'=>165],
        );  

        foreach($testData as $data){
            $dateCalc = new DateCalculator(
                new Date($data['sDate']),
                new Date($data['eDate'])
            );
            $this->assertTrue($dateCalc->calcDiffTotalDays() == $data['days']);
        }

    }
}
