<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 13.04.18
 * Time: 14:12
 */

namespace App\Controller;


use App\CustomContext;
use App\BusinessLogic\Usecase\LemmaUsecase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class LemmaController extends Controller
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

        $itemUsecase = new LemmaUsecase();

        return $this->render("article/lemma.html.twig", [
           "item" => $itemUsecase->constructItem($id)
        ]);
    }
}