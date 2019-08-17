<?php


namespace App\Helpers\PluginModules;


class Vip extends PMFrame implements PMInterface
{
    public function getUserData() {
        return $this->connect()
            ->table($this->pluginObject->table_players['name'])
            ->where($this->pluginObject->table_players['col'], $this->steamid)
            ->first();
    }
}
