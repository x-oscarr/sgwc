<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RulesItem extends Model
{
    public function category()
    {
        return $this->belongsTo('App\RulesCategory', 'rules_categories_id', 'id');
    }

    public function reports()
    {
        return $this->hasMany('App\Report', 'rule_id', 'id');
    }

    public function countViolations()
    {
        $this->hasMany('App\Report', 'rule_id', 'id')->where('status', true)->count();
    }
}
