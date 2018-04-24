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

        if ($nextReference->lemma == null) {
            $viewItem->nextVisibility = "invisible";
        } else {
            $viewItem->nextLemma = $nextReference->lemma;
            $viewItem->nextId = $nextReference->internal_id;
        }
        if ($previousReference->lemma == null) {
            $viewItem->previousVisibility = "invisible";
        } else {
            $viewItem->previousLemma = $previousReference->lemma;
            $viewItem->previousId = $previousReference->internal_id;
        }

        dump($viewItem);
        return $viewItem;
    }
}