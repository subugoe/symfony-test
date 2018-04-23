<?php

namespace App\Usecase;

use App\CustomContext;
use App\ViewModel\ViewItem;

/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 11:15
 */
class ItemUsecase
{

    private $gateway;

    public function __construct() {
        $this->gateway = CustomContext::$backendGateway;
    }

    public function constructItem(string $itemId): ViewItem {

        $backendItem = $this->gateway->getItemById($itemId);
        $nextReference = $this->gateway->getNextReference($backendItem->sortKey);
        $previousReference = $this->gateway->getPreviousReference($backendItem->sortKey);

        $viewItem = new ViewItem();
        $viewItem->lemma = $backendItem->lemma;
        $viewItem->article = $backendItem->article;
        $viewItem->nextLemma = $nextReference->lemma;
        $viewItem->nextId = $nextReference->internal_id;
        $viewItem->previousLemma = $previousReference->lemma;
        $viewItem->previousId = $previousReference->internal_id;

        return $viewItem;
    }
}