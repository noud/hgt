<?php

namespace HGT\AppBundle\Controller\News;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/nieuws", name="news_index")
     */
    public function indexAction(Request $request)
    {
        return $this->render('news/index.html.twig');
    }
}
