<?php
/**
 * Created by PhpStorm.
 * User: dennis
 * Date: 20.04.18
 * Time: 11:22
 */

namespace App\BusinessLogic\ViewModel;


class ViewItem
{
    public $lemma;
    public $article;

    public $nextLemma;
    public $nextId;
    public $nextVisibility = "visible";

    public $previousLemma;
    public $previousId;
    public $previousVisibility = "visible";
}