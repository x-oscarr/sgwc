<?php

namespace App\Http\Controllers\Admin;

use App\MenuItem;
use App\SiteModule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function index()
    {
        $siteModules = SiteModule::all();
        $siteModulesOptions = [null => 'None'];
        foreach ($siteModules as $siteModule) {
            $siteModulesOptions[$siteModule->id] = $siteModule->name;
        }

        return view('admin.settings.index', [
            'siteModulesOptions' => $siteModulesOptions
        ]);
    }

    public function servers()
    {


        return view('admin.settings.servers', [

        ]);
    }

    public function design()
    {


        return view('admin.settings.design', [

        ]);
    }

    public function web()
    {


        return view('admin.settings.web', [

        ]);
    }

    public function permissions()
    {


        return view('admin.settings.permissions', [

        ]);
    }

    public function seo()
    {
        return 'dev';
    }

    public function donate()
    {
        return 'dev';
    }

    public function getMenuItem(Request $request) {
        if($request->all()) {
            $menuItem = MenuItem::find($request->get('id'));
            if($menuItem) {
                return \response()->json(['menuItem' => $menuItem, 'childMenuItem' => $menuItem->child], '200');
            }
            return \response()->json(['error' => 'Not found menu item'], '500');
        }
        return \response()->json(['error' => 'Not found data in request'], '500');
    }

    public function updateMenuItem(Request $request) {
        if($request->all()) {
            $itemDataArr = $request->get('itemData');
            $itemChildDataArr = $request->get('itemChildData');
            $itemsPositions = $request->get('itemsPosition');
            if($itemDataArr) {
                foreach ($itemDataArr as $data) {
                    $itemData[$data['name']] = $data['value'];
                }

                if(isset($itemData['itemId']) && $itemData['itemId']) {
                    $menuItem = MenuItem::find($itemData['itemId']);
                }
                else {
                    $menuItem = new MenuItem();
                    $itemData['siteModule'] = $itemData['newSiteModule'];
                    $itemData['text'] = $itemData['newText'];
                    $itemData['access'] = $itemData['newAccess'];
                    $itemData['accessParams'] = $itemData['newAccessParams'];
                    $itemData['route'] = $itemData['newRoute'];
                    $itemData['routeParams'] = $itemData['newRouteParams'];
                    $itemData['type'] = $itemData['newType'];
                }
                $menuItem->site_module_id = $itemData['siteModule'];
                $menuItem->text = $itemData['text'];
                $menuItem->access = $itemData['access'];
                $menuItem->access_params = $itemData['accessParams'];
                $menuItem->route = $itemData['route'];
                $menuItem->route_params = $itemData['routeParams'];
                $menuItem->type = $itemData['type'] ?? null;
                $menuItem->save();

                if(isset($itemData['itemChild']) && $itemData['itemChild']) {
                    $menuItem->child->text = $itemData['childText'];
                    $menuItem->child->route = $itemData['childRoute'];
                    $menuItem->child->route_params = $itemData['childRouteParams'];
                    $menuItem->child->save();
                }
            }

            if($itemChildDataArr) {
                foreach ($itemChildDataArr as $data) {
                    $itemChildData[$data['name']] = $data['value'];
                }
                $menuItem = MenuItem::find($itemChildData['newChildItemParentId']);
                $menuItem->child->text = $itemChildData['newChildText'];
                $menuItem->child->route = $itemChildData['newChildRoute'];
                $menuItem->child->route_params = $itemChildData['newChildRouteParams'];
                $menuItem->child->save();
            }

            if($itemsPositions) {
               foreach ($itemsPositions as $item) {
                   $menuItem = MenuItem::find($item['id']);
                   $menuItem->position = $item['position'];
                   $menuItem->save();

                   if($menuItem->child) {
                       $menuItem->child->position = $item['position'];
                       $menuItem->child->save();
                   }
               }
            }
            return \response()->json(['status' => true], '200');
        }
        return \response()->json(['error' => 'Not found data in request'], '500');
    }
}
