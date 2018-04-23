<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 11:31
 */

namespace App\Gateway;


interface BackendGateway
{
    function getItemById($id);
    function getNextReference($sortKey);
    function getPreviousReference($sortKey);
}