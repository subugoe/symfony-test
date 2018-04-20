<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 11:32
 */

namespace App\Gateway;


use App\CustomContext;
use Solarium\Client;

class SolrGateway implements BackendGateway
{

    private $client;

    function __construct() {
        $config = array(
            'endpoint' => array(
                'fwbdev' => array(
                    'host' => '0.0.0.0',
                    'port' => 8083,
                    'path' => '/solr/fwb',
                )
            )
        );
        $this->client = new Client($config);
    }

    function getItemById($id)
    {
        $client = $this->client;

        $query = $client->createSelect()->setQuery("internal_id:".$id);
        $query->setHandler("article");
        $resultset = $client->execute($query);

        dump($resultset->getDocuments()[0]);

        return "my-item " . $id;
    }
}