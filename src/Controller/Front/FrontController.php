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
class FrontController extends AbstractController
{
    /**
     * @Route("/home", name="home.index")
     */
    public function indexAction(Request $request)
    {
       $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();
        $mangas = $em->getRepository(Manga::class)->findSome();
        return $this->render('front/home.html.twig', ['categories'=>$categories , 'mangas'=>$mangas ]);
    }

    /**
     * @Route("/home/category/{id}", name="category.index")
     */
    public function categoryAction(Category $cat)
    {
      $em = $this->getDoctrine()->getManager();
     
      $categories = $em->getRepository(Category::class)->findAll();
      $mangas = $em->getRepository(Manga::class)->findByCat($cat);
      return $this->render('front/category.html.twig',['mangas' =>$mangas, 'category' =>$cat , 'categories' => $categories]);
   }
   
     /**
     * @Route("/home/manga/{id}", name="manga.index")
     */
    public function MangaAction( Manga $manga , Request $request )
    {   $em = $this->getDoctrine()->getManager();
        $reviews=$em->getRepository(Review::class)->findAllbyManga($manga);
        $categories = $em->getRepository(Category::class)->findAll();
       
        $review = new Review();
        $review->setManga($manga);
        $form = $this->createForm(ReviewType::class , $review  );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
          {  
            $em->persist($review);
             $em->flush();
             
          } 


        return $this->render('front/single.html.twig', [
          'manga' => $manga , 
          'categories' => $categories  , 
          'reviews' => $reviews ,
          'review' => $review ,
          'form' => $form->createView() 
          ]);
      
   }

    
}