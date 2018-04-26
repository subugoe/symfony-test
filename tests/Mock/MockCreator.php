<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 26.04.18
 * Time: 15:36
 */

namespace App\Tests\Mock;


use App\CustomContext;
use App\Gateway\BackendGateway;
use PHPUnit\Framework\TestCase;

class MockCreator extends TestCase
{
    private $mockGateway;

    public function __construct()
    {
        $this->mockGateway = $this->createMock(BackendGateway::class);
        CustomContext::$backendGateway = $this->mockGateway;

    }

    public function createMockFromArray($mockFunctions) {
        foreach ($mockFunctions as $functionName => $returns) {
            $returnedObject = $returns['return'];
            foreach ($returns['properties'] as $property => $value) {
                $returnedObject->$property = $value;
            }
            $this->mockGateway->method($functionName)->willReturn($returnedObject);
        }

    }
}