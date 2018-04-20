<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 13.04.18
 * Time: 14:12
 */

namespace App\Controller;


use App\CustomContext;
use App\Usecase\ItemUsecase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{
    /**
     * @Route("/")
     */
    public function homepage() {
        return new Response("homepage");
    }

    /**
     * @Route("/lemma/{id}", name="_lemma", methods={"GET"})
     */
    public function lemma($id) {

        $itemUsecase = new ItemUsecase();
        $item = $itemUsecase->constructItem($id);

        return $this->render("article/item.html.twig", [
           "lemma" => $item->lemma
        ]);
    }
}