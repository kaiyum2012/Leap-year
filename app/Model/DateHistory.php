<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DateHistory extends Model
{
    //
    protected $table ='tbl_date_histoty';

    protected $fillable = ['start_date', 'end_date', 'days'];

    public $timestamps = true;

}
