<?php

namespace HGT\AppBundle\Controller\Search;

use HGT\Application\Search\SearchService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/zoeken", name="search_index")
     */
    public function indexAction(
        Request $request,
        SearchService $searchService
    ) {
        $query = $request->query->get('q');

        $searchResults = null;
        $hasResults = false;

        if (trim($query) !== "") {
            $searchResults = $searchService->searchAllStuff($query);

            foreach ($searchResults as $searchResult) {
                if (count($searchResult) > 0) {
                    $hasResults = true;
                }
            }
        }

        return $this->render('search/index.html.twig', [
            'searchResults' => $searchResults,
            'hasResults' => $hasResults
        ]);
    }
}
