<?php

namespace HGT\AppBundle\Controller\Page;

use HGT\Application\Content\Page\Page;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("page/{id}", name="page")
     * @param Page $page
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, Page $page)
    {
        return $this->render('page/index.html.twig', [
            'page' => $page
        ]);
    }
}
