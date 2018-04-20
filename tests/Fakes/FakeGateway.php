<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 12:26
 */

namespace App\Tests\Fakes;


use App\Gateway\BackendGateway;

class FakeGateway implements BackendGateway
{

    function getItemById($id)
    {
        return "fake item " . $id;
    }
}