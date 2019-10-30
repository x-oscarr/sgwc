<?php

namespace App\Http\Controllers\Admin;

use App\MenuItem;
use App\Setting;
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
            'siteModulesOptions' => $siteModulesOptions,
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

    public function updateSettings(Request $request)
    {
        $settingsData = $request->get('settingsData');
        if($settingsData) {
            foreach ($settingsData as $settingItem) {
                $setting = Setting::getParam($settingItem['name'], true);
                $setting->value = $settingItem['value'];
                $saveResult = $setting->save();
                if(!$saveResult) {
                    return \response()->json(['status' => false, 'error' => 'Setting '.$settingItem['name'].' not saved with value '.$settingItem['value']], '500');
                }
            }
            return \response()->json(['status' => true], '200');
        }
        return \response()->json(['status' => false, 'error' => 'Not found data in request'], '500');
    }

    public function getMenuItem(Request $request)
    {
        if($request->all()) {
            $menuItem = MenuItem::find($request->get('id'));
            if($menuItem) {
                return \response()->json(['status' => true, 'menuItem' => $menuItem, 'childMenuItem' => $menuItem->child], '200');
            }
            return \response()->json(['status' => false, 'error' => 'Not found menu item'], '500');
        }
        return \response()->json(['status' => false, 'error' => 'Not found data in request'], '500');
    }

    public function updateMenuItem(Request $request)
    {
        if($request->all()) {
            $itemDataArr = $request->get('itemData');
            $newItemDataArr = $request->get('newItemData');
            $itemChildDataArr = $request->get('itemChildData');
            $itemsPositions = $request->get('itemsPosition');
            $itemDelete = $request->get('itemDelete');
            $childItemDelete = $request->get('childItemDelete');

            // Update item and child item
            if($itemDataArr) {
                foreach ($itemDataArr as $data) {
                    $itemData[$data['name']] = $data['value'];
                }
                if(isset($itemData['itemId']) && $itemData['itemId']) {
                    $menuItem = MenuItem::find($itemData['itemId']);
                    $menuItem->site_module_id = $itemData['siteModule'];
                    $menuItem->text = $itemData['text'];
                    $menuItem->access = $itemData['access'];
                    $menuItem->access_params = $itemData['accessParams'];
                    $menuItem->route = $itemData['route'];
                    $menuItem->route_params = $itemData['routeParams'];
                    $menuItem->type = $itemData['type'] ?? null;
                    $saveItemResult = $menuItem->save();

                    if(isset($itemData['itemChild']) && $itemData['itemChild']) {
                        $menuItem->child->text = $itemData['childText'];
                        $menuItem->child->route = $itemData['childRoute'];
                        $menuItem->child->route_params = $itemData['childRouteParams'];
                        $saveItemResult = $menuItem->child->save();

                        if($saveItemResult) $status = true;
                        else $errors[] = 'Failed to update menu item (child)';
                    }
                    elseif($saveItemResult) $status = true;
                    else $errors[] = 'Failed to update menu item (parent)';
                }
                //$resultUpdateItem = $status ?? false;
            }
            //Create item
            if($newItemDataArr) {
                foreach ($newItemDataArr as $data) {
                    $itemData[$data['name']] = $data['value'];
                }
                $menuItem = new MenuItem();
                $menuItem->site_module_id = $itemData['newSiteModule'];
                $menuItem->text = $itemData['newText'];
                $menuItem->access = $itemData['newAccess'];
                $menuItem->access_params = $itemData['newAccessParams'];
                $menuItem->route = $itemData['newRoute'];
                $menuItem->route_params = $itemData['newRouteParams'];
                $menuItem->type = $itemData['newType'] ?? null;
                $saveItemResult = $menuItem->save();

                if(!$saveItemResult) $errors[] = 'Failed to add menu item (parent)';
                //$resultCreateItem = $saveItemResult;
            }

            // Create child item
            if($itemChildDataArr) {
                foreach ($itemChildDataArr as $data) {
                    $itemChildData[$data['name']] = $data['value'];
                }
                $parentItem = MenuItem::find($itemChildData['newChildItemParentId']);
                if($parentItem->child) {
                    $childItem = $parentItem->child;
                }
                else $childItem = new MenuItem();
                $childItem->parent_id = $itemChildData['newChildItemParentId'];
                $childItem->text = $itemChildData['newChildText'];
                $childItem->route = $itemChildData['newChildRoute'];
                $childItem->route_params = $itemChildData['newChildRouteParams'];
                $childItem->position = $parentItem->position;
                $childItem->type = $parentItem->type;
                $saveItemResult = $childItem->save();

                if(!$saveItemResult) $errors[] = 'Failed to add menu item (child)';
                //$resultCreateChildItem = $saveItemResult;
            }

            // Delete Item and child item
            if($itemDelete) {
                foreach ($itemDelete as $data) {
                    $itemData[$data['name']] = $data['value'];
                }
                $menuItem = MenuItem::find($itemData['itemId']);
                if($menuItem->child) {
                    $menuItem->child->delete();
                }
                $menuItem->delete();
            }

            //Delete child item
            if($childItemDelete) {
                foreach ($childItemDelete as $data) {
                    $itemData[$data['name']] = $data['value'];
                }
                $menuItem = MenuItem::find($itemData['itemId']);
                if($menuItem->child) {
                    $menuItem->child->delete();
                }
                else $errors[] = 'Not found child item';
            }

            // Menu item positions
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

            if(!isset($errors) || empty($errors)) {
                return \response()->json(['status' => true], '200');
            }
            else {
                return \response()->json(['status' => false, 'errors' => $errors], '500');
            }

        }
        return \response()->json(['status' => false, 'error' => 'Not found data in request'], '500');
    }
}
