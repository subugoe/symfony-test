<?php


namespace App\Tests\Usecase;

use App\Tests\Mock\MockCreator;
use App\BusinessLogic\Usecase\LemmaUsecase;
use App\BusinessLogic\Model\Item;
use App\BusinessLogic\Model\Reference;
use Exception;
use PHPUnit\Framework\TestCase;

class LemmaUsecaseTest extends TestCase
{
    private $mockCreator;
    private $itemUsecase;

    public function setUp()
    {
        $this->mockCreator = new MockCreator();
        $this->itemUsecase = new LemmaUsecase();
    }

    public function test_exceptionWhenNoItemFound() {

        $this->mockCreator->createMockFromArray( [
            'getItemById' => [[]]
        ] );

        $this->expectException(Exception::class);

        $this->itemUsecase->constructItem("id here unnecessary");
    }

    public function test_exceptionWhenTwoItemsFound() {

        $this->mockCreator->createMockFromArray( [
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
        ] );

        $this->expectException(Exception::class);

        $this->itemUsecase->constructItem("id here unnecessary");
    }

    public function test_happyPath() {

        $this->mockCreator->createMockFromArray( [
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
        ] );

        $viewItem = $this->itemUsecase->constructItem("id here unnecessary");

        $this->assertEquals("fake_lemma", $viewItem->lemma);
        $this->assertEquals("next_fake_lemma", $viewItem->nextLemma);
        $this->assertEquals("previous_fake_lemma", $viewItem->previousLemma);
        $this->assertEquals("my article", $viewItem->article);
    }

    public function test_nextReferenceIsInvisible() {

        $this->mockCreator->createMockFromArray( [
            'getItemById' =>
                [['return' => new Item(),
                    'properties' => [
                        'lemma' => 'fake_lemma',
                        'article' => "my article"]]],
            'getNextReference' =>
                [[]],
            'getPreviousReference' =>
                [['return' => new Reference(),
                    'properties' => [
                        'lemma' => 'previous_fake_lemma']]]
        ] );

        $viewItem = $this->itemUsecase->constructItem("id here unnecessary");

        $this->assertEquals("invisible", $viewItem->nextVisibility);
        $this->assertEquals("visible", $viewItem->previousVisibility);
    }

}
