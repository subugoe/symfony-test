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

        $backendItems = $this->gateway->getItemById($itemId);
        if (count($backendItems) == 0) {
            throw new \Exception("ID not found: " . $itemId);
        } elseif (count($backendItems) > 1) {
            throw new \Exception("Got more than one document for: " . $itemId);
        }
        $backendItem = $backendItems[0];

        $nextReferences = $this->gateway->getNextReference($backendItem->sortKey);
        if (count($nextReferences) > 1) {
            throw new \Exception("Got more than one next reference for " . $itemId);
        }

        $previousReferences = $this->gateway->getPreviousReference($backendItem->sortKey);
        if (count($previousReferences) > 1) {
            throw new \Exception("Got more than one previous reference for " . $itemId);
        }

        return $this->createViewItemFrom($backendItem, $nextReferences, $previousReferences);
    }

    private function createViewItemFrom($backendItem, $nextReferences, $previousReferences) {
        $viewItem = new ViewItem();
        $viewItem->lemma = $backendItem->lemma;
        $viewItem->article = $backendItem->article;

        if (count($nextReferences) == 0) {
            $viewItem->nextVisibility = "invisible";
        } else {
            $nextReference = $nextReferences[0];
            $viewItem->nextLemma = $nextReference->lemma;
            $viewItem->nextId = $nextReference->internal_id;
        }
        if (count($previousReferences) == 0) {
            $viewItem->previousVisibility = "invisible";
        } else {
            $previousReference = $previousReferences[0];
            $viewItem->previousLemma = $previousReference->lemma;
            $viewItem->previousId = $previousReference->internal_id;
        }

        dump($viewItem);
        return $viewItem;
    }
}