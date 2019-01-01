<?php
namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use App\Repository\MangaRepository;
use App\Repository\ReviewRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
class NumberController extends AbstractController
{
 
     /**
      * @Route("/admin/number", name="admin.number")
      */
     public function index(CategoryRepository $repoC , MangaRepository $repoM ,ReviewRepository $repoR)
     {
       $nbrCat = count($repoC->findAll());
       $nbrM = count($repoM->findAll());
       $nbrRev = count($repoR->findAll());
    
        return $this->render('admin/number.html.twig' , [
            'nbrCat' => $nbrCat ,
            'nbrM' => $nbrM ,
            'nbrRev' => $nbrRev 
            ]);
     }

    
    
}