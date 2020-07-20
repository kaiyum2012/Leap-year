<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Helper\DateCalculator;
use App\Helper\Date;

class DateCalculatorTest extends TestCase
{
    /**@test
     * @return void
     */
    public function testDateDiffCalcTest()
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

    /**@test
     * @return void
     */
    public function testDateLeapYearTest()
    {
        $leapYears = array(
            '29-02-1904','29-02-1908','29-02-1912','29-02-1916','29-02-1920','29-02-1924','29-02-1928','29-02-1932','29-02-1936','29-02-1940','29-02-1944','29-02-1948','29-02-1952','29-02-1956','29-02-1960','29-02-1964','29-02-1968','29-02-1972','29-02-1976','29-02-1980','29-02-1984','29-02-1988','29-02-1992','29-02-1996','29-02-2000','29-02-2004','29-02-2008','29-02-2012','29-02-2016','29-02-2020','29-02-2024','29-02-2028','29-02-2032','29-02-2036','29-02-2040','29-02-2044','29-02-2048','29-02-2052','29-02-2056','29-02-2060','29-02-2064','29-02-2068','29-02-2072','29-02-2076','29-02-2080','29-02-2084','29-02-2088','29-02-2092','29-02-2096');  

        foreach($leapYears as $date){
            $d = new Date($date);
            $this->assertTrue($d->isLeapYear());
        }
    }


    /**@test
     * @return void
     */
    public function testNonLeapYearDateTest(){
        $dates = array(
            '13-06-1993','15-12-2067','29-02-1911','29-02-2015','31-12-2019');

        foreach($dates as $date){
            $d = new Date($date);
            $this->assertFalse($d->isLeapYear());
        }
    }
}
