<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 13.04.18
 * Time: 14:12
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    public function homepage() {
        return new Response("homepage");
    }

    public function news() {
        return new Response("news");
    }
}