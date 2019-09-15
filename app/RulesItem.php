<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RulesItem extends Model
{
    public function category()
    {
        return $this->belongsTo('App\RulesCategory', 'rules_categories_id', 'id');
    }
}
