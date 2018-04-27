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
    function getItemById($id) : array;
    function getNextReference($sortKey) : array;
    function getPreviousReference($sortKey) : array;
}