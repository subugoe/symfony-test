<?php


namespace App\Tests\Usecase;

use App\CustomContext;
use App\Gateway\BackendGateway;

use App\Tests\Mock\MockCreator;
use App\Usecase\ItemUsecase;
use App\Model\Item;
use App\Model\Reference;
use PHPUnit\Framework\TestCase;

class ItemUsecaseTest extends TestCase
{
    public function testFake() {

        $mockFunctions = [
            'getItemById' =>
                [['return' => new Item(),
                    'properties' => [
                        'lemma' => 'fake_lemma',
                        'article' => "my article"]]],
            'getNextReference' =>
                [['return' => new Reference(),
                    'properties' => [
                        'lemma' => 'next_fake_lemma']]],
            'getPreviousReference' =>
                [['return' => new Reference(),
                    'properties' => [
                        'lemma' => 'previous_fake_lemma']]]
        ];

        $mockCreator = new MockCreator();
        $mockCreator->createMockFromArray($mockFunctions);

        $itemUsecase = new ItemUsecase();
        $viewItem = $itemUsecase->constructItem("id here unnecessary");

        $this->assertEquals("fake_lemma", $viewItem->lemma);
        $this->assertEquals("next_fake_lemma", $viewItem->nextLemma);
        $this->assertEquals("previous_fake_lemma", $viewItem->previousLemma);
        $this->assertEquals("my article", $viewItem->article);
    }

}
