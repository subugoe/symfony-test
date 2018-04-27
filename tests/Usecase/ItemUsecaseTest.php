<?php


namespace App\Tests\Usecase;

use App\Tests\Mock\MockCreator;
use App\Usecase\ItemUsecase;
use App\Model\Item;
use App\Model\Reference;
use Exception;
use PHPUnit\Framework\TestCase;

class ItemUsecaseTest extends TestCase
{
    private $mockCreator;
    private $itemUsecase;

    public function setUp()
    {
        $this->mockCreator = new MockCreator();
        $this->itemUsecase = new ItemUsecase();
    }

    public function test_exceptionWhenNoItemFound() {

        $mockFunctions = [
            'getItemById' => [[]]
        ];
        $this->mockCreator->createMockFromArray($mockFunctions);

        $this->expectException(Exception::class);

        $this->itemUsecase->constructItem("id here unnecessary");
    }

    public function test_exceptionWhenTwoItemsFound() {

        $mockFunctions = [
            'getItemById' =>
                [
                    ['return' => new Item(),
                        'properties' => [
                            'lemma' => 'fake_lemma',
                            'article' => "my article"]],
                    ['return' => new Item(),
                        'properties' => [
                            'lemma' => 'fake_lemma2',
                            'article' => "my article2"]]
                ]
        ];
        $this->mockCreator->createMockFromArray($mockFunctions);

        $this->expectException(Exception::class);

        $this->itemUsecase->constructItem("id here unnecessary");
    }

    public function test_happyPath() {

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
        $this->mockCreator->createMockFromArray($mockFunctions);

        $viewItem = $this->itemUsecase->constructItem("id here unnecessary");

        $this->assertEquals("fake_lemma", $viewItem->lemma);
        $this->assertEquals("next_fake_lemma", $viewItem->nextLemma);
        $this->assertEquals("previous_fake_lemma", $viewItem->previousLemma);
        $this->assertEquals("my article", $viewItem->article);
    }

}
