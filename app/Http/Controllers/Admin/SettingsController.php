<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Monitoring;
use App\Helpers\PMLoader;
use App\MenuItem;
use App\PluginModule;
use App\Server;
use App\Setting;
use App\SiteModule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    // public/@path
    const DEFAULT_PRELOADER_PATH = 'img/preloaders';
    // public/storage/@path
    const CUSTOM_PRELOADER_PATH = 'design/preloaders';

    public function index()
    {
        $siteModules = SiteModule::all();
        $siteModulesOptions = [null => 'None'];
        foreach ($siteModules as $siteModule) {
            $siteModulesOptions[$siteModule->id] = $siteModule->name;
        }

        $routeCollection = Route::getRoutes();
        foreach ($routeCollection as $route) {
            if($route->getName()) {
                $routeList[$route->getName()] = $route->uri();
            }
        }

        return view('admin.settings.index', [
            'siteModulesOptions' => $siteModulesOptions,
            'routeList' => $routeList
        ]);
    }

    public function servers(Monitoring $monitoring)
    {
        $servers = Server::all();
        foreach ($servers as $server) {
            $serversMonitoring[$server->id] = $monitoring->Online($server->ip, $server->port);
        }

        $pluginModules = PluginModule::all();
        $pluginModulesLibrary = PMLoader::getLibrary();
        foreach ($pluginModulesLibrary as $key => $value) {
            $pluginModulesList[$key] = $value['class'];
        }

        return view('admin.settings.servers', [
            'serversMonitoring' => $serversMonitoring ?? null,
            'pluginModulesList' => $pluginModulesList ?? null,
            'pluginModules' => $pluginModules
        ]);
    }

    public function design()
    {
        $preloaders = File::files(self::DEFAULT_PRELOADER_PATH);
        //dd($preloaders);
        return view('admin.settings.design', [
            'preloaderPath' => self::DEFAULT_PRELOADER_PATH,
            'preloaders' => $preloaders,
        ]);
    }

    public function web()
    {
        $siteModules = SiteModule::all();
        return view('admin.settings.web', [
            'siteModules' => $siteModules
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

    public function updateSM(Request $request)
    {
        $smEnable = $request->get('smEnable');
        if($smEnable) {
            $id = $smEnable['id'];
            $value = $smEnable['value'];
            if($id) {
                $siteModule = SiteModule::find($id);
                if($siteModule) {
                    $siteModule->is_enabled = $value ?? 0;
                    $saveResult = $siteModule->save();
                    if($saveResult) {
                        return \response()->json(['status' => true], '200');
                    }
                    else {
                        $error = 'Save error';
                    }
                }
                else {
                    $error = 'Not found web module';
                }
            }
        }
        return \response()->json(['status' => false, 'error' => $error ?? 'Not found data in request'], '500');
    }

    public function getPM(Request $request)
    {
        $id = $request->get('id');
        if($id) {
            $pluginModule = PluginModule::find($id);
            if($pluginModule) {
                return \response()->json(['status' => true, 'pluginModule' => $pluginModule], '200');
            }
            else {
                $error = 'Plugin module';
            }
        }
        return \response()->json(['status' => false, 'error' => $error ?? 'Not found data in request'], '500');
    }

    public function updateServers(Request $request)
    {
        $serversDataArr = $request->get('serversData');
        $addServersDataArr = $request->get('addServerData');
        $deleteServer = $request->get('deleteServer');

        if($serversDataArr) {
            foreach ($serversDataArr as $serverFormData) {
                if ($serverFormData['name'] == '_token') continue;
                $parseInput = explode('_', $serverFormData['name'], 2);
                $id = $parseInput[1] ?? null;
                $name = $parseInput[0] ?? null;
                $value = $serverFormData['value'];
                $serversData[$id][$name] = $value;
            }
            foreach ($serversData as $key => $serverData) {
                $server = Server::find($key);
                $server->ip = $serverData['ip'];
                $server->port = $serverData['port'];
                $server->display = $serverData['display'];
                $server->monitoring = $serverData['monitoring'];
                $server->save();
            }
            return \response()->json(['status' => true], '200');
        }
        if($addServersDataArr) {
            foreach ($addServersDataArr as $data) {
                $addServersData[$data['name']] = $data['value'];
            }
            $server = new Server();
            $server->name = $addServersData['serverName'];
            $server->reduction = $addServersData['slug'];
            $server->ip = $addServersData['ip'];
            $server->port = $addServersData['port'];
            $server->rcon = $addServersData['rcon'];
            $server->save();

            return \response()->json(['status' => true], '200');
        }
        if($deleteServer) {
            Server::find($deleteServer)->delete();
            return \response()->json(['status' => true], '200');
        }

        return \response()->json(['status' => false, 'error' => $error ?? 'Not found data in request'], '500');
    }

    public function updatePM(Request $request)
    {
        $pmDataUpdateArr = $request->get('pmDataUpdate');
        $pmEnable = $request->get('pmEnable');

        if($pmDataUpdateArr) {
            foreach ($pmDataUpdateArr as $data) {
                $pmDataUpdate[$data['name']] = $data['value'];
            }
            $pluginModule = PluginModule::find($pmDataUpdate['pmId']);
            if($pluginModule) {
                $pluginModule->plugin = $pmDataUpdate['plugin'];
                $pluginModule->name = $pmDataUpdate['pmName'];
                $pluginModule->description = $pmDataUpdate['description'];
                $pluginModule->db = $pmDataUpdate['dbName'];
                $pluginModule->db_host = $pmDataUpdate['dbHost'];
                $pluginModule->db_port = $pmDataUpdate['dbPort'];
                $pluginModule->db_username = $pmDataUpdate['dbUser'];
                $pluginModule->db_password = $pmDataUpdate['dbPassword'];
                $saveResult = $pluginModule->save();

                if($saveResult) {
                    return \response()->json(['status' => true], '200');
                }
                else {
                    $error = 'Save error';
                }
            }
            else {
                $error = 'Not found plugin module';
            }
        }

        if($pmEnable) {
            $id = $pmEnable['id'];
            $value = $pmEnable['value'];
            if($id) {
                $pluginModule = PluginModule::find($id);
                if($pluginModule) {
                    $pluginModule->is_enabled = $value ?? 0;
                    $saveResult = $pluginModule->save();
                    if($saveResult) {
                        return \response()->json(['status' => true], '200');
                    }
                    else {
                        $error = 'Save error';
                    }
                }
                else {
                    $error = 'Not found plugin module';
                }
            }
        }

        return \response()->json(['status' => false, 'error' => $error ?? 'Not found data in request'], '500');
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
