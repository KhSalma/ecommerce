<?php
namespace App\Controller\Front;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Entity\Review;
use App\Entity\Manga;
use App\Form\ReviewType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Session\Session;
class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     */
    public function indexAction(Request $request)
    {
      $session = new Session();
      
      @$cart=$session->get('cart');
      $mangas=$this->getDoctrine()->getManager()->getRepository(Manga::class)->findById(array_keys($cart));
      if(empty($cart))
      {
          return $this->redirectToRoute('cart');
      }
        return $this->render('front/cart.html.twig' , ['mangas' => $mangas, 'cart' => $cart  ]);
    }

    /**
     * @Route("/cart/add/{id}", name="cart.add")
     */
    public function addAction(int $id , Request $request)
    {
      $session = new Session();

      @$cart=$session->get('cart');
      
            $qty = $request->query->get('qty');
            @$cart[$id] = $qty;
       
      
      
      $session->set('cart', $cart);
       return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/delete/{id}", name="cart.delete")
     */
    public function deleteAction(int $id)
    {
      $session = new Session();
      @$cart=$session->get('cart');
      unset($cart[$id]);
      $session->set('cart', $cart);
      if(empty($cart))
      {
          return $this->redirectToRoute('cart.clear');
      }
      return $this->redirectToRoute('cart');
      
    }

    /**
     * @Route("/cart/clear", name="cart.clear")
     */
    public function clearAction()
    {   $session = new Session();
        @$cart=$session->remove('cart');

        return $this->render('front/clear.html.twig');
        

    }

   

    
}