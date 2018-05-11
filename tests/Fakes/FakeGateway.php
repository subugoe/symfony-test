<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 12:26
 */

namespace App\Tests\Fakes;


use App\BusinessLogic\Gateway\BackendGateway;
use App\BusinessLogic\Model\Item;
use App\BusinessLogic\Model\Reference;

class FakeGateway implements BackendGateway
{

    function getItemById($id) : array
    {
        $item = new Item();
        $item->lemma = "fake_lemma";
        $item->sortKey = "fake_sort_key";
        $item->internal_id = "fake_lemma_id";
        $item->article = "Empty article";
        return array($item);
    }

    function getNextReference($sortKey) : array
    {
        $ref = new Reference();
        $ref->lemma = "next_fake_lemma";
        $ref->internal_id = "next_fake_id";
        return array($ref);
    }

    function getPreviousReference($sortKey) : array
    {
        $ref = new Reference();
        $ref->lemma = "previous_fake_lemma";
        $ref->internal_id = "previous_fake_id";
        return array($ref);
    }
}