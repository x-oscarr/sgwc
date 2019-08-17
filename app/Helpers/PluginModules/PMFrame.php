<?php


namespace App\Helpers\PluginModules;

use Illuminate\Support\Facades\DB;
use Syntax\SteamApi\Facades\SteamApi;


class PMFrame
{
    protected $pluginObject;
    protected $steamid;

    public function __construct($pluginObject, $steamid)
    {
        $this->pluginObject = $pluginObject;
        $steamid = SteamApi::convertId($steamid, $pluginObject->auth);
        if (is_object($steamid)) {
            switch ($pluginObject->auth) {
                case 'ID3_S':
                    preg_match('/[0-9]{9,11}/', $steamid->id3, $steamid);
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
}
