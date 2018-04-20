<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 11:32
 */

namespace App\Gateway;


class SolrGateway implements BackendGateway
{

    function getItemById($id)
    {
        return "my-item " . $id;
    }
}