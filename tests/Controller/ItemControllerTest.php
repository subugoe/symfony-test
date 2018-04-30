<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 30.04.18
 * Time: 15:37
 */

namespace App\Tests\Controller;


use App\CustomContext;
use App\Tests\Fakes\FakeGateway;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class Test extends WebTestCase
{

    private $client;

    public function setUp() {
        $this->client = static::createClient();
    }

    private function getFromResponse($urlPath, $xpath) {
        $crawler = $this->client->request('GET', $urlPath);
        return $crawler->evaluate($xpath)->text();
    }

    public function test_fakeLemmaFromFakeGateway() {
        CustomContext::$backendGateway = new FakeGateway();

        $returnedLemma = $this->getFromResponse("/lemma/some-id", "//h1[1]");

        $this->assertEquals("fake_lemma", $returnedLemma);
    }

}
