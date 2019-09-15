<?php

namespace App\Http\Controllers;

use App\RulesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RulesController extends Controller
{
    public function index()
    {
        $rules_data = RulesCategory::all();
        foreach ($rules_data as $rules_category) {
            if ($rules_category->parent_id == null) {
                $primary_categories[] = $rules_category;
            }
        }

        //dd($primary_categories);
        return view('rules.index', [
            'primary_categories' => $primary_categories,
        ]);
    }

    public function rules($slug)
    {

    }
}
