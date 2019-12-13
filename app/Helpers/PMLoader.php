<?php


namespace App\Helpers;

use App\PluginModule;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Exception;

class PMLoader
{
    public const ROUTE_ACCESS_PERMISSION = 'permission';
    public const ROUTE_ACCESS_ROLE = 'role';
    public const ROUTE_METHOD_GET = 'get';
    public const ROUTE_METhOD_POST = 'post';
    public const ROUTE_METHOD_ANY = 'any';
    public const ROUTE_NAME_PREFIX = 'pm.';
    public const ROUTE_ACTION_DIR = 'PluginModules';

    private const PLUGINS_DIR = 'Helpers/PluginModules/';

    static public function getData($pluginObject, $steamid) {
        $plugin_settings = self::getParams($pluginObject);

        $plugin_path = app_path(self::PLUGINS_DIR.$plugin_settings['class'].'.php');
        if (!file_exists($plugin_path)) {
            Throw new Exception('Plugin Module "'.$pluginObject->plugin.'" not found in '.$plugin_path );
        }

        $plugin_settings['class'] = 'App\Helpers\PluginModules\\'.$plugin_settings['class'];
        $pluginObject = (object) array_merge((array) $pluginObject, (array) $plugin_settings);
        $plugin = new $plugin_settings['class']($pluginObject, $steamid);

        return $plugin;
    }

    static public function getParams($pluginObject) {
        $plugin_modules_library = self::getLibrary();
        $plugin_settings = $plugin_modules_library[$pluginObject->plugin];
        return $plugin_settings;
    }

    static public function getLibrary() {
        $plugin_modules_json = base_path(env('PLUGIN_MODULES_JSON', 'plugin_modules.json'));
        if (!file_exists($plugin_modules_json)) {
            Throw new Exception($plugin_modules_json.' not found!' );
        }
        $plugin_modules_library = file_get_contents($plugin_modules_json);
        $plugin_modules_library = json_decode($plugin_modules_library, true);
        if (!$plugin_modules_library) {
            Throw new Exception($plugin_modules_json.' parse error or empty!' );
        }
        return $plugin_modules_library;
    }

    static public function getRoutes() {
        $pluginsModules = PluginModule::all();
        foreach ($pluginsModules as $plugin) {
            $pluginParams = self::getParams($plugin);
            if($pluginParams) {
                foreach ($pluginParams['routes'] as $key => $route) {
                    $routeController = explode('@', $route['action'])[0];
                    $routePath = app_path('Http/Controllers/'.self::ROUTE_ACTION_DIR.'/'.$routeController.'.php');

                    if (!file_exists($routePath)) {
                        Throw new Exception('Plugin Module Controller "'.$plugin->plugin.'" not found in '.$routePath );
                    }

                    if (!isset($route['path'])) {
                        Throw new Exception('Plugin module "'.$plugin->plugin.'" route "'.$key.'" has no path');
                    }

                    if (!isset($route['action'])) {
                        Throw new Exception('Plugin module "'.$plugin->plugin.'" route "'.$key.'" has no action');
                    }

                    switch ($route['access'] ?? null) {
                        case self::ROUTE_ACCESS_ROLE: $routeAccess = ['auth', 'rbac:role,'.$route['access_params']];
                            break;
                        case self::ROUTE_ACCESS_PERMISSION: $routeAccess = ['auth', 'rbac:can,'.$route['access_params']];
                            break;
                        default: $routeAccess = null;
                    }

                    $routeParams = [
                        'uses' => self::ROUTE_ACTION_DIR.'\\'.$route['action'],
                        'as' => self::ROUTE_NAME_PREFIX.$route['name'] ?? null,
                        'middleware' => $routeAccess,
                    ];

                    switch ($route['method'] ?? self::ROUTE_METHOD_GET) {
                        case self::ROUTE_METHOD_GET: Route::get($route['path'], $routeParams);
                            break;
                        case self::ROUTE_METhOD_POST: Route::post($route['path'], $routeParams);
                            break;
                        case self::ROUTE_METHOD_ANY: Route::any($route['path'], $routeParams);
                            break;
                    }

                }
            }
        }
        return true;
    }
}
