<?php

namespace App\Helpers;

use xPaw\SourceQuery\SourceQuery;

class Monitoring
{
    private $sq_engine;

    public function __construct($sq_engine = SourceQuery::SOURCE)
    {
        $this->sq_engine = $sq_engine;
    }

    private function getData($ip, $port) {
        $Query = new SourceQuery();
        try
        {
            $Query->Connect($ip, $port, 1, $this->sq_engine);
            $server_data['info'] = $Query->GetInfo();
            $server_data['players'] = $Query->GetPlayers();
            $server_data['rules'] = $Query->GetRules();
        }
        catch( Exception $e )
        {
            $server_data['errors'] = $e->getMessage();
        }
        finally
        {
            $Query->Disconnect();
        }
        return $server_data;
    }

    public function Online($ip, $port) {
        $server_data = $this->getData($ip, $port);
        if(isset($server_data['error']) || $server_data['info'] == false) {
            return $server['online'] = false;
        }

        $server['online'] = true;
        // Server Info
        $map_mod = strtolower(explode('_' ,$server_data['info']['Map'])[0]);
        $map_mod_dir = env('MAP_MOD_DIR', 'img/game_type/');
        $map_mod_img = $map_mod_dir . $map_mod . env('MAP_MOD_FILE_FORMAT', '.png');
        $map_mod_library_json = env('MAP_MOD_JSON', 'mapmods.json');

        if(!file_exists($map_mod_img)) {
            $map_mod_img = $map_mod_dir . env('MAP_MOD_DEFAULT', 'undefined.png');
        }

        if (file_exists($map_mod_library_json)) {
            $map_mod_library = file_get_contents($map_mod_library_json);
            $map_mod_library = json_decode($map_mod_library, true);
            $map_mod_name = $map_mod_library['en'][$map_mod] ?? $map_mod;
        }

        $server['info'] = [
            'hostname' => $server_data['info']['HostName'],
            'ip' => $ip,
            'port' => $port,
            'map' => $server_data['info']['Map'],
            'map_mod' => $map_mod,
            'map_mod_img' => $map_mod_img,
            'map_mod_name' => $map_mod_name,
            'game_dir' => $server_data['info']['ModDir'],
            'game_name' => $server_data['info']['ModDesc'],
            'players' => $server_data['info']['Players'],
            'max_players' => $server_data['info']['MaxPlayers'],
            'vac' => $server_data['info']['Secure'],
            'tags' => $server_data['info']['GameTags'],
        ];

        // Players
        foreach ($server_data['players'] as $player) {
            $server['players'][] = [
                'name' => $player['Name'] == '' ? 'Connecting' : $player['Name'],
                'score' => $player['Frags'],
                'timestamp' => $player['Time'],
                'time' => $player['TimeF']
            ];
        }

        return $server;
    }
}
