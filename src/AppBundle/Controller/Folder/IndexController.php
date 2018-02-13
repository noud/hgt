<?php

namespace HGT\AppBundle\Controller\Folder;

use HGT\Application\Content\FolderPageService;
use HGT\Application\Content\FolderService;
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

    }

    /**
     * @Route("/folder", name="folder_index")
     */
    public function indexAction(Request $request, FolderService $folderService)
    {
        return $this->render('folder/index.html.twig', [
            'folders' => $folderService->getActiveFolders(),
        ]);
    }

    /**
     * @Route("/folder/view/{id}", name="folder_view")
     */
    public function viewAction(Request $request, FolderService $folderService, FolderPageService $folderPageService, $id)
    {
        return $this->render('folder/view.html.twig', [
            'folder_images' => $folderPageService->getFolderPagesByFolderId($id)
        ]);
    }

}
