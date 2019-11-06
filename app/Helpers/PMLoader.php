<?php


namespace App\Helpers;

use PHPUnit\Framework\Exception;

class PMLoader
{
    static private $plugins_dir = 'Helpers/PluginModules/';

    static public function getData($pluginObject, $steamid) {
        $plugin_settings = self::getParams($pluginObject);

        $plugin_path = app_path(self::$plugins_dir.$plugin_settings['class'].'.php');
        if (!file_exists($plugin_path)) {
            Throw new Exception('Plugin Module "'.$pluginObject->plugin.'" not found in'.$plugin_path );
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
}
