<?php
namespace App\Controller\Front;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Entity\Review;
use App\Entity\Manga;
use App\Entity\Order;
use App\Form\OrderType;
use App\Form\ReviewType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\Session;
class OrderController extends AbstractController
{
     /**
     * @Route("/order", name="order")
     */
    public function indexAction(Request $request)
    { $em = $this->getDoctrine()->getManager();
      $session = new Session();
      
      @$cart=$session->get('cart');
      $mangas=$this->getDoctrine()->getManager()->getRepository(Manga::class)->findById(array_keys($cart));
      if(empty($cart))
      {
          return $this->redirectToRoute('cart');
      }

        $order= new order();
        $form = $this->createForm(OrderType::class , $order  );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
          {  
            $em->persist($order);
             $em->flush();
             
          } 
        return $this->render('front/validation.html.twig' , [
            'mangas' => $mangas, 
            'cart' => $cart ,
            'order' => $order ,
            'form' => $form->createView()
           ]);
    }
}