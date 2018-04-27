<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 11:32
 */

namespace App\Gateway;


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

    public function getItemById($id) : array
    {
        $query = $this->client->createSelect()->setQuery("internal_id:".$id)->setHandler("article");
        return $this->getItemsFromSolr($query);
    }

    private function getItemsFromSolr($query) {
        $resultset = $this->client->execute($query);
        $items = [];

        foreach ($resultset->getDocuments() as $resultDoc) {
            $item = new Item();
            $item->lemma = $resultDoc["lemma"];
            $item->sortKey = $resultDoc["sortkey"];
            $item->article = $resultDoc["artikel"];
            array_push($items, $item);
        }
        return $items;
    }

    public function getNextReference($sortKey) : array
    {
        $query = $this->client->createSelect()
            ->addSort('sortkey', "asc")
            ->setQuery(sprintf('sortkey:{%s TO *]', $sortKey))
            ->setRows(1)
            ->setFields(['lemma', 'internal_id']);
        return $this->getReferencesFromSolr($query);
    }

    public function getPreviousReference($sortKey) : array
    {
        $query = $this->client->createSelect()
            ->addSort('sortkey', "desc")
            ->setQuery(sprintf('sortkey:[* TO %s}', $sortKey))
            ->setRows(1)
            ->setFields(['lemma', 'internal_id']);
        return $this->getReferencesFromSolr($query);
    }

    private function getReferencesFromSolr($query) {
        $resultset = $this->client->execute($query);
        $refs = [];

        foreach ($resultset->getDocuments() as $resultDoc) {
            $ref = new Reference();
            $ref->lemma = $resultDoc["lemma"];
            $ref->internal_id = $resultDoc["internal_id"];
            array_push($refs, $ref);
        }

        return $refs;

    }
}