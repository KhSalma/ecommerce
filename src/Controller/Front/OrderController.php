<?php
namespace App\Controller\Front;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Repository\MangaRepository;
use App\Entity\Manga;
use App\Entity\OrderManga;
use App\Entity\Orderr;
use App\Form\OrderType;
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
    public function indexAction(Request $request ,MangaRepository $repoM)
    {   $em = $this->getDoctrine()->getManager();
        $session = new Session();
        
        @$cart=$session->get('cart');
        $mangas=$this->getDoctrine()->getManager()->getRepository(Manga::class)->findById(array_keys($cart));
        if(empty($cart))
        {
            return $this->redirectToRoute('cart');
        }
        $order= new orderr();
        $form = $this->createForm(OrderType::class , $order  );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
          {  
            $em->persist($order);
            foreach ($cart as $manga_id => $qty) {
                $orderManga = new OrderManga();
                $orderManga->setQuantity($qty);
                $manga = $repoM->find($manga_id);
                $orderManga->setPrice($manga->getPrice());
                $orderManga->setManga($manga);
                $orderManga->setOrderr($order);

                $em->persist($orderManga);
            }
             $em->flush();
             $session->clear();
             $this->addFlash('success' , 'Validated order');
             return $this->redirectToRoute('home.index') ;
             
          } 

        return $this->render('front/validation.html.twig' , [
            'mangas' => $mangas, 
            'cart' => $cart,
            'order' => $order ,
            'form' => $form->createView()
        ]);
        
    }
    

   

   

    
}