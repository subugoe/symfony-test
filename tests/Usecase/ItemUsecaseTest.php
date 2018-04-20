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
        $lemma = $itemUsecase->constructItem("test")->lemma;
        $this->assertEquals("fake item test", $lemma);
    }
}
