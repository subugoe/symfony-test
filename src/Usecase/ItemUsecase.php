<?php

namespace App\Usecase;

use App\CustomContext;
use App\ViewModel\Item;

/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 11:15
 */
class ItemUsecase
{

    public function constructItem(string $itemId): Item {
        $gateway = CustomContext::$backendGateway;

        $backendItem = $gateway->getItemById($itemId);
        $item = new Item();
        $item->lemma = $backendItem;

        return $item;
    }
}