<?php

namespace HGT\AppBundle\Controller\News;

use HGT\Application\Content\News\News;
use HGT\Application\Content\NewsService;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/nieuws", name="news_index")
     * @param Request $request
     * @param NewsService $newsService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(
        Request $request,
        NewsService $newsService
    ) {
        /** @var $news */
        $news = $newsService->getActiveNews();

        return $this->render('news/index.html.twig', [
            'news' => $news
        ]);
    }

    /**
     * @Route("/nieuws/{id}", name="news_view")
     * @param Request $request
     * @param NewsService $newsService
     * @param News $news
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(
        Request $request,
        NewsService $newsService,
        News $news
    ) {
        return $this->render('news/view.html.twig', [
            'news' => $news
        ]);
    }
}
