<?php


namespace App\Helpers\PluginModules;


class Sourcebans extends PMFrame implements PMInterface
{
    public function getUserData() {
        return $this->connect()
            ->table($this->pluginObject->table_players['name'])
            ->where($this->pluginObject->table_players['col'], 'STEAM_1:0:209903272')
            ->orderByDesc('created')
            ->limit(5)
            ->get();
    }
}
