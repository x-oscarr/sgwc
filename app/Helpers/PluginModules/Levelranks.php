<?php


namespace App\Helpers\PluginModules;


class Levelranks extends PMFrame implements PMInterface
{

    public function getUserData() {
        return $this->connect()
            ->table($this->pluginObject->table_players['name'])
            ->where($this->pluginObject->table_players['col'], $this->steamid)
            ->first();
    }

    public function getTopUserData($sort_by = 'value') {
        return $this->getTop([$this->pluginObject->table_players['col'], 'name', 'rank', 'playtime'], $sort_by);
    }

}
