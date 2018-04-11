<?php

namespace HGT\AppBundle\Controller\Page;

use HGT\Application\Breadcrumb\BreadcrumbService;
use HGT\Application\Content\Page\Page;
use HGT\Application\Content\PageService;
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
    public function indexAction(
        Request $request,
        Page $page,
        PageService $pageService,
        BreadcrumbService $breadcrumbService
    ) {
        $breadcrumbService->addBreadcrumb($page->getTitle(), '');
        $breadcrumbs = $breadcrumbService->getBreadcrumbs();

        return $this->render('page/index.html.twig', [
            'page' => $page,
            'breadcrumbs' => $breadcrumbs
        ]);
    }
}
