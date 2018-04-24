<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 11:32
 */

namespace App\Gateway;


use App\CustomContext;
use App\Model\Item;
use App\Model\Reference;
use Solarium\Client;

class SolrGateway implements BackendGateway
{

    private $client;

    public function __construct() {
        $config = array(
            'endpoint' => array(
                'fwbdev' => array(
                    'host' => '134.76.0.0',
                    'port' => 8083,
                    'path' => '/solr/fwb',
                )
            )
        );
        $this->client = new Client($config);
    }

    public function getItemById($id)
    {
        $query = $this->client->createSelect()->setQuery("internal_id:".$id)->setHandler("article");
        return $this->itemFromFirstResult($query);
    }

    private function itemFromFirstResult($query) {
        $resultset = $this->client->execute($query);
        $resultDoc = $resultset->getDocuments()[0];

        $item = new Item();
        $item->lemma = $resultDoc["lemma"];
        $item->sortKey = $resultDoc["sortkey"];
        $item->article = $resultDoc["artikel"];

        return $item;
    }

    public function getNextReference($sortKey)
    {
        $query = $this->client->createSelect()
            ->addSort('sortkey', "asc")
            ->setQuery(sprintf('sortkey:{%s TO *]', $sortKey))
            ->setRows(1)
            ->setFields(['lemma', 'internal_id']);
        return $this->referenceFromFirstResult($query);
    }

    public function getPreviousReference($sortKey)
    {
        $query = $this->client->createSelect()
            ->addSort('sortkey', "desc")
            ->setQuery(sprintf('sortkey:[* TO %s}', $sortKey))
            ->setRows(1)
            ->setFields(['lemma', 'internal_id']);
        return $this->referenceFromFirstResult($query);
    }

    private function referenceFromFirstResult($query) {
        $resultset = $this->client->execute($query);
        $ref = new Reference();

        foreach ($resultset->getDocuments() as $resultDoc) {
            $ref->lemma = $resultDoc["lemma"];
            $ref->internal_id = $resultDoc["internal_id"];
        }

        return $ref;

    }
}