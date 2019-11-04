<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RulesCategory extends Model
{
    public function server()
    {
        return $this->belongsTo('App\Server');
    }

    public function rules()
    {
        return $this->hasMany('App\RulesItem', 'rules_categories_id', 'id');
    }

    public function parentCategory()
    {
        return $this->belongsTo('App\RulesCategory', 'parent_id', 'id');
    }

    public function subCategory()
    {
        return $this->hasMany('App\RulesCategory', 'parent_id', 'id');
    }
}
