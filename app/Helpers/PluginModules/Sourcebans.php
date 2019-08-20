<?php


namespace App\Helpers\PluginModules;


class Sourcebans extends PMFrame implements PMInterface
{
    public function getUserData() {
        $sb['bans'] = $this->connect()
            ->table($this->pluginObject->table_bans['name'])
            ->where($this->pluginObject->table_bans['col'], $this->steamid)
            ->orderByDesc('created')
            ->limit(5)
            ->get();

        $sb['comms'] = $this->connect()
            ->table($this->pluginObject->table_comms['name'])
            ->where($this->pluginObject->table_comms['col'], $this->steamid)
            ->orderByDesc('created')
            ->limit(5)
            ->get();

        $sb['count_bans'] = $this->connect()
            ->table($this->pluginObject->table_bans['name'])
            ->where($this->pluginObject->table_bans['col'], $this->steamid)
            ->count();

        $sb['count_comms'] = $this->connect()
            ->table($this->pluginObject->table_comms['name'])
            ->where($this->pluginObject->table_comms['col'], $this->steamid)
            ->count();

        $sb['is_banned'] = false;
        foreach ($sb['bans'] as $ban) {
            $ban->ends >= time() ? $sb['is_banned'] = true : null;
        }

        $sb['is_muted'] = false;
        foreach ($sb['comms'] as $comm) {
            $comm->ends >= time() ? $sb['is_muted'] = $comm->type : null;
        }

        return $sb;
    }
}
