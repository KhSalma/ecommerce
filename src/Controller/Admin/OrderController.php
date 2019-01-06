<?php
namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\OrderRepository;
use App\Entity\Orderr;
use Knp\Component\Pager\PaginatorInterface ;


class OrderController extends AbstractController
{

  /**
    * @var OrderRepository
    */
    private $repository;

    public function __construct(OrderRepository $repository , ObjectManager $em )
    {
        $this->repository = $repository ;
        $this->em = $em;
        
    }
 
     /**
      * @Route("/admin/order", name="admin.order")
      */
     public function indexAction( Request $request ,PaginatorInterface $paginator  )
     { 
        $orders=$paginator->paginate(
            $this->repository->findAllOrders() , 
            $request->query->getInt('page', 1),
            4
       );

    
      return $this->render('admin/order/index.html.twig' , ['orders' => $orders] );
     }
     /**
      * @Route("/admin/order/details/{id}", name="admin.order.details")
      */
      public function detailsAction( Request $request , Orderr $order )
      {
       
       return $this->render('admin/order/details.html.twig' , ['order' => $order] );
      }

    
    
}