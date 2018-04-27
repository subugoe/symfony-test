<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 12:26
 */

namespace App\Tests\Fakes;


use App\Gateway\BackendGateway;
use App\Model\Item;
use App\Model\Reference;

class FakeGateway implements BackendGateway
{

    function getItemById($id) : array
    {
        $item = new Item();
        $item->lemma = "fake_lemma";
        $item->sortKey = "fake_sort_key";
        return array($item);
    }

    function getNextReference($sortKey) : array
    {
        $ref = new Reference();
        $ref->lemma = "next_fake_lemma";
        return array($ref);
    }

    function getPreviousReference($sortKey) : array
    {
        $ref = new Reference();
        $ref->lemma = "previous_fake_lemma";
        return array($ref);
    }
}