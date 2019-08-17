<?php


namespace App\Helpers\PluginModules;


class LK extends PMFrame implements PMInterface
{

    public function getUserData() {
        $lk['userdata'] = $this->connect()
            ->table($this->pluginObject->table_players['name'])
            ->where($this->pluginObject->table_players['col'], $this->steamid)
            ->first();

        $lk['pays'] = $this->connect()
            ->table($this->pluginObject->table_pays['name'])
            ->where($this->pluginObject->table_pays['col'], $this->steamid)
            ->where('pay_status', true)
            ->orderByDesc('pay_data')
            ->limit(5)
            ->get();
        return $lk;
    }

}
