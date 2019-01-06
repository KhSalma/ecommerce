<?php
namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use App\Repository\MangaRepository;
use App\Repository\OrderMangaRepository;
use App\Repository\ReviewRepository;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
class NumberController extends AbstractController
{
 
     /**
      * @Route("/admin", name="admin")
      */
     public function index(CategoryRepository $repoC , MangaRepository $repoM , OrderRepository $repoOr , OrderMangaRepository $repoOM ,ReviewRepository $repoR)
     {
       $nbrCat = count($repoC->findAll());
       $nbrM = count($repoM->findAll());
       $nbrOr = count($repoOr->findAll());
       $total =$repoOM->FindTotal();
       $nbrRev = count($repoR->findAll());
    
        return $this->render('admin/number.html.twig' , [
            'nbrCat' => $nbrCat ,
            'nbrM' => $nbrM ,
            'nbrOr' => $nbrOr ,
            'total' => $total ,
            'nbrRev' => $nbrRev 
            ]);
     }

    
    
}