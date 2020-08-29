<?php

if(!function_exists('isSteamId')) {
    function isSteamId($str) {
        if (is_string($str) && (
            preg_match('/^STEAM_[0-1]:([0-1]):([0-9]+)$/', $str) || //Steam32
            preg_match('/^[0-9]+$/', $str) ||                       //Steam64
            preg_match('/^\[U:1:([0-9]+)\]$/', $str)                //Steam3
        )) {
            return true;
        }
        return false;
    }
}

?>
