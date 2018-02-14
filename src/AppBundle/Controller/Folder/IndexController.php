<?php

namespace HGT\AppBundle\Controller\Folder;

use HGT\Application\Content\Folder\Folder;
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

//        $someArr = [
//
//            'page_id' => 1,
//            'content' =>
//                [
//                    'left' => '1.jpg',
//                    'right' => '2.jpg',
//                ],
//
//            'page_id' => 2,
//            'content' =>
//                [
//                    'left' => '3.jpg',
//                    'right' => '4.jpg'
//                ]
//            ]
//        ];


        $i = 0;

        $images = count($folderPageService->getFolderPagesByFolderId($id));
        $pages = ceil($images / 2);

        dump($images);
        dump($pages);






//
//
//        foreach($folderPageService->getFolderPagesByFolderId($id) as $item) {
//
//            $i++;
//
//            if ($i % 2 == 0) {
//                dump($item);
//                $someArr['left'] = $item;
//                //dump('right');
//            } else {
//                $someArr['right'] = $item;
//
//            }
//
//        }
//
//        dump($someArr);




        return $this->render('folder/view.html.twig', [
            'folder' => $folderService->getFolder($id),
            'folder_images' => $folderPageService->getFolderPagesByFolderId($id),
        ]);
    }

}
