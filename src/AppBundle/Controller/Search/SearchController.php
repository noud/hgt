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

        if(isset($query)) {
            if (trim($query) !== "") {
                $searchResults = $searchService->searchAllStuff($query);
                foreach ($searchResults as $searchResult) {
                    if (count($searchResult) > 0) {
                        $hasResults = true;
                    }
                }
            } else {
                $this->addFlash('search_notice', 'Vul a.u.b. een zoekopdracht in van minimaal 3 tekens.');
                return $this->redirectToRoute('search_index');
            }
        }

        dump($searchResults);

        return $this->render('search/index.html.twig', [
            'searchResults' => $searchResults,
            'resultNumber' => count($searchResults, COUNT_RECURSIVE) - count($searchResults),
            'searchQuery' => $query,
            'hasResults' => $hasResults
        ]);
    }
}
