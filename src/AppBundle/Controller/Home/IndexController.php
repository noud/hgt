<?php

namespace HGT\AppBundle\Controller\Home;

use HGT\Application\Catalog\CategoryService;
use HGT\Application\Content\HomeBannerService;
use HGT\Application\Content\HomeSlideService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * IndexController constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @param HomeSlideService $homeSlideService
     * @param HomeBannerService $homeBannerService
     * @param CategoryService $categoryService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, HomeSlideService $homeSlideService, HomeBannerService $homeBannerService, CategoryService $categoryService)
    {
        $homeSlides = $homeSlideService->getHomeSlides();
        $homeBanners = $homeBannerService->getHomeSlides();
        $homeCategories = $categoryService->getHomeCategories();

        return $this->render('index/index.html.twig', [
            'homeSlides' => $homeSlides,
            'homeBanners' => $homeBanners,
            'homeCategories' => $homeCategories,
        ]);
    }
}
