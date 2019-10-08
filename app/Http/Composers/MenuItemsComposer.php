<?php

namespace App\Http\Composers;

use App\MenuItem;
use Illuminate\View\View;

class MenuItemsComposer
{
    protected $elements;
    /**
     * @var array
     * name => type: string, Name
     * access => type: array ['type' => 'auth' OR 'permission' OR 'role', 'data'], Access to element
     * element => type: array ['text', 'route'], Main element(if used access=true)
     * alt_element => type: array ['text', 'route'], Alternative element (if used access=false)
     */
    protected $static = [
        [
            'name' => '',
            'access' => [
                'type' => '',
                'data' => ''
            ],
            'element' => [
                'text' => '',
                'route' => '',
            ],
            'alt_element' => [
                'text' => '',
                'route' => ''
            ]
        ]
    ];
    public function __construct()
    {
       $menu_items = $this->elements = MenuItem::all();
       dd($menu_items[0]->child());
    }

    public function compose(View $view)
    {
        $view->with('list_menu', $this->elements);
    }
}