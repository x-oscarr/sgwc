<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportDispute extends Model
{
    public function report()
    {
        return $this->belongsTo('App\Report', 'report_id', 'id');
    }
}
