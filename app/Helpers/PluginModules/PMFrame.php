<?php


namespace App\Helpers\PluginModules;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Syntax\SteamApi\Facades\SteamApi;


class PMFrame
{
    public $pluginObject;
    public $steamid;

    public function __construct($pluginObject, $steamid) {
        $this->pluginObject = $pluginObject;
        $steamid = SteamApi::convertId($steamid, $pluginObject->auth);
        if (is_object($steamid)) {
            switch ($pluginObject->auth) {
                case 'ID3_S':
                    preg_match('/^\[U:1:([0-9]+)\]$/', $steamid->id3, $steamid);
                    $steamid = $steamid[0];
                    break;
            }
        }
        $this->steamid = $steamid;
    }

    protected function connect() {
        config(['database.connections.'.$this->pluginObject->plugin => [
            'driver' => 'mysql',
            'host' => $this->pluginObject->db_host,
            'port' => $this->pluginObject->db_port,
            'username' => $this->pluginObject->db_username,
            'password' => $this->pluginObject->db_password,
            'database' => $this->pluginObject->db,
        ]]);
        return DB::connection($this->pluginObject->plugin);
    }

    protected function getTop(array $columns, string $sort_by) {
        return $this->connect()->transaction(function () use(&$sort_by, &$columns) {
            $this->connect()->statement('SET @place = 0');
            $result = $this->connect()->table($this->pluginObject->table_players['name'])
                ->selectRaw('@place:=@place+1 AS place,'.implode(',', $columns))
                ->orderByDesc($sort_by)
                ->get()->toArray();
            return $result;
        });
    }

    public function getUserData() {
        return $this->connect()
            ->table($this->pluginObject->table_players['name'])
            ->where($this->pluginObject->table_players['col'], $this->steamid)
            ->first();
    }
}
