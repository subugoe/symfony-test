<?php


namespace App\Tests\Usecase;

use App\CustomContext;

use App\Tests\Fakes\FakeGateway;
use App\Usecase\ItemUsecase;
use PHPUnit\Framework\TestCase;

class ItemUsecaseTest extends TestCase
{

    public function testBla() {

        CustomContext::$backendGateway = new FakeGateway();

        $itemUsecase = new ItemUsecase();
        $viewItem = $itemUsecase->constructItem("test");

        $this->assertEquals("fake_lemma", $viewItem->lemma);
        $this->assertEquals("next_fake_lemma", $viewItem->nextLemma);
        $this->assertEquals("previous_fake_lemma", $viewItem->previousLemma);
    }
}
