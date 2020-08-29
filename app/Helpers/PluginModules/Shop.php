<?php


namespace App\Helpers\PluginModules;


use App\ShopItem;
use Illuminate\Support\Facades\DB;

class Shop extends PMFrame implements PMInterface
{

    public function getUserData() {
        $shop['userdata'] = $this->connect()
            ->table($this->pluginObject->table_players['name'])
            ->where($this->pluginObject->table_players['col'], $this->steamid)
            ->first();

        $shop['inventory'] = $this->getUserInventory();

        return $shop;
    }

    public function getTopUserData($sort_by = 'money') {
        return $this->getTop(['name', $this->pluginObject->table_players['col'], 'money'], $sort_by);
    }

    public function getUserInventory() {
        $user = $this->connect()
            ->table($this->pluginObject->table_players['name'])
            ->get(['id', $this->pluginObject->table_players['col']])
            ->where($this->pluginObject->table_players['col'], $this->steamid)
            ->first();

        if (is_null($user))
            return null;

        $boughtsItems = $this->connect()
            ->table($this->pluginObject->table_boughts['name'])
            ->where($this->pluginObject->table_boughts['col'], $user->id)
            ->where('timeleft', '>=', 0)
            ->get();

        foreach ($boughtsItems as $item) {
            $ids[] = $item->item_id;
        }

        $itemData = ShopItem::whereIn('item_id', $ids ?? null)->where('display', true)->get();
        $shopItems = [];

        foreach ($itemData as $item) {
            foreach ($boughtsItems as $bItem) {
                if($bItem->item_id == $item->item_id)
                    break;
            }
            $shopItems[] = [
                'itemData' => $item,
                'boughtData' => $bItem
            ];
        }

        return $shopItems;
    }
}
