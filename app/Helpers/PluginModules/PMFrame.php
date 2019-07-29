<?php


namespace App\Helpers\PluginModules;

use Illuminate\Support\Facades\DB;


class PMFrame
{
    protected $pluginObject;
    protected $steamid;

    public function __construct($pluginObject, $steamid)
    {
        $this->pluginObject = $pluginObject;
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
