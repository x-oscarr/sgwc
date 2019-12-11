<?php


namespace App\Helpers;

use App\PluginModule;
use PHPUnit\Framework\Exception;

class PMLoader
{
    private const PLUGINS_DIR = 'Helpers/PluginModules/';
    private const PLUGINS_CONTROLLER_DIR = 'PluginModules/';

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
        $plugin_modules_json = env('PLUGIN_MODULES_JSON', 'plugin_modules.json');
        if (!file_exists($plugin_modules_json)) {
            Throw new Exception($plugin_modules_json.' not found!' );
        }
        $plugin_modules_library = file_get_contents($plugin_modules_json);
        $plugin_modules_library = json_decode($plugin_modules_library, true);

        return $plugin_modules_library;
    }

    static public function getRoutes() {
        $pluginsRoutes = [];

        $pluginsModules = PluginModule::all();
        foreach ($pluginsModules as $plugin) {
            $pluginParams = self::getParams($plugin);
            if($pluginParams) {
                foreach ($pluginParams['routes'] as $route) {
                    $routeController = explode('@', $route['action'])[0];
                    $routePath = app_path('Http/Controllers/'.self::PLUGINS_CONTROLLER_DIR.$routeController.'.php');

                    if (!file_exists($routePath)) {
                        Throw new Exception('Plugin Module Controller "'.$plugin->plugin.'" not found in '.$routePath );
                    }

                    $pluginsRoutes[$route['name']] = ['action' => $route['action']];
                }
            }
        }

        return $pluginsRoutes;
    }
}
