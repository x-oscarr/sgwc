<?php


namespace App\Helpers\PluginModules;


class Shop extends PMFrame
{

    public function getUserData() {
        return $this->connect()
            ->table($this->pluginObject->table_players['name'])
            ->where($this->pluginObject->table_players['col'], $this->steamid)
            ->first();
    }

//    private function getUserInventory() {
//        $user = $this->connect()
//            ->table($this->pluginObject->table_players['name'])
//            ->get(['id', $this->pluginObject->table_players['col']])
//            ->where($this->pluginObject->table_players['col'], $this->steamid)
//            ->first();
//
//        if (is_null($user))
//            return null;
//
//        $boughts_items = $this->connect()
//            ->table($this->pluginObject->table_toggles['name'])
//            ->get([$this->pluginObject->table_toggles['col'], 'item_id'])
//            ->where($this->pluginObject->table_toggles['col'], $user->id);
//
//    }
}
