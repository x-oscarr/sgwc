<?php


namespace App\Helpers\PluginModules;


class Levelranks extends PMFrame
{

    public function getUserData() {
        return $this->connect()
            ->table($this->pluginObject->table_players['name'])
            ->where($this->pluginObject->table_players['col'], $this->steamid)
            ->first();
    }

}
