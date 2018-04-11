<?php

namespace HGT\AppBundle\Controller\Search;

use Doctrine\ORM\Tools\Pagination\Paginator;
use HGT\Application\Breadcrumb\BreadcrumbService;
use HGT\Application\Catalog\CategoryService;
use HGT\Application\Search\SearchService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/zoeken", name="search_index")
     * @param Request $request
     * @param SearchService $searchService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(
        Request $request,
        SearchService $searchService,
        CategoryService $categoryService,
        BreadcrumbService $breadcrumbService
    ) {
        $breadcrumbService->addBreadcrumb('Zoeken', '');
        $breadcrumbs = $breadcrumbService->getBreadcrumbs();

        $homeCategories = $categoryService->getHomeCategories();

        $query = $request->query->has('q') ?
            trim($request->query->get('q')) : false;

        $currentPage = $request->query->has('p') ?
            (int)$request->query->get('p') : 1;

        $perPage = $request->query->has('limit') ?
            (int)$request->query->get('limit') : 1;

        if (!$query || strlen($query) < 3) {
            return $this->render('search/index.html.twig', [
                'error' => 'Vul a.u.b. een zoekopdracht in van minimaal 3 tekens.',
                'breadcrumbs' => $breadcrumbs
            ]);
        }

        $resultNumber = 0;
        $searchResults = $searchService->searchAll($currentPage, $perPage, $query);

        /** @var Paginator $paginator */
        $paginator = $searchResults['products'];

        $pagination = array(
            'current' => $currentPage,
            'pages' => ceil($paginator->count() / $perPage)
        );

        if ($currentPage != 1 && ($currentPage > $pagination['pages'] || $currentPage < 1)) {
            throw $this->createNotFoundException();
        }

        foreach ($searchResults as $searchResult) {
            $resultNumber += count($searchResult);
        }

        return $this->render('search/index.html.twig', [
            'homeCategories' => $homeCategories,
            'searchResults' => $searchResults,
            'resultNumber' => $resultNumber,
            'searchQuery' => $query,
            'perPage' => $perPage,
            'pagination' => $pagination,
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
