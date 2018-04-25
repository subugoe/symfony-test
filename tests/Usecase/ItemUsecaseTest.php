<?php


namespace App\Tests\Usecase;

use App\CustomContext;
use App\Gateway\BackendGateway;

use App\Usecase\ItemUsecase;
use App\Model\Item;
use App\Model\Reference;
use PHPUnit\Framework\TestCase;

class ItemUsecaseTest extends TestCase
{
    private $mockGateway;

    function setUp() {
        $this->mockGateway = $this->createMock(BackendGateway::class);
        CustomContext::$backendGateway = $this->mockGateway;
        
    }

    public function testFake() {

        $this->configureMock();

        $itemUsecase = new ItemUsecase();
        $viewItem = $itemUsecase->constructItem("test");

        $this->assertEquals("fake_lemma", $viewItem->lemma);
        $this->assertEquals("next_fake_lemma", $viewItem->nextLemma);
        $this->assertEquals("previous_fake_lemma", $viewItem->previousLemma);
    }

    private function configureMock() {
        $item = new Item();
        $item->lemma = "fake_lemma";
        $this->mockGateway->method('getItemById')->willReturn($item);

        $nextRef = new Reference();
        $nextRef->lemma = "next_fake_lemma";
        $this->mockGateway->method('getNextReference')->willReturn($nextRef);
        
        $prevRef = new Reference();
        $prevRef->lemma = "previous_fake_lemma";
        $this->mockGateway->method('getPreviousReference')->willReturn($prevRef);
        
    }
}
