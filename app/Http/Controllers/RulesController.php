<?php

namespace App\Http\Controllers;

use App\RulesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RulesController extends Controller
{
    public function index()
    {
        $rulesData = RulesCategory::all();
        if($rulesData->isNotEmpty()) {
            foreach ($rulesData as $rulesCategory) {
                if ($rulesCategory->parent_id == null) {
                    $primaryCategories[] = $rulesCategory;
                }
            }
        }
        return view('rules.index', [
            'primary_categories' => $primaryCategories ?? null,
        ]);
    }

    public function rules($slug)
    {

    }
}
