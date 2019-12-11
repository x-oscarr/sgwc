<?php

namespace App;

use App\Helpers\PluginModules\Shop;
use App\Helpers\PMLoader;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use PHPUnit\Framework\Exception;

class ShopItem extends Model
{
    public $timestamps = false;

    public static function get($itemKeyOrId) {

    }

    public static function getByUser($user) {
        if(!$user instanceof User) {
            $user = User::find($user);
        }
        $pluginModules = DB::table('plugin_modules')->where('plugin', 'shop')->first();
        if (!$pluginModules || !$user) {
            Throw new Exception('Undefined Plugin Module or User');
        }
        $inventoryData = PMLoader::getData($pluginModules, $user->steam32)->getUserInventory();
        return $inventoryData;
    }
}
