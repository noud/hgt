<?php

namespace HGT\AppBundle\Controller\Folder;

use HGT\Application\Content\Folder\Folder;
use HGT\Application\Content\FolderPageService;
use HGT\Application\Content\FolderService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FolderController extends Controller
{
    /**
     * @Route("/folder", name="folder_index")
     * @param Request $request
     * @param FolderService $folderService
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, FolderService $folderService)
    {
        $activeFolders = $folderService->getActiveFolders();

        return $this->render('folder/index.html.twig', [
            'folders' => $activeFolders,
        ]);
    }

    /**
     * @Route("/folder/view/{id}", name="folder_view")
     * @param Request $request
     * @param FolderPageService $folderPageService
     * @param Folder $folder
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction(
        Request $request,
        FolderPageService $folderPageService,
        Folder $folder
    ) {
        return $this->render('folder/view.html.twig', [
            'folder' => $folder,
            'folder_images' => $folderPageService->getFolderPagesByFolderId($folder->getId()),
        ]);
    }
}
