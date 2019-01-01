<?php
namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\ReviewRepository;
use App\Entity\Review;
use App\Form\ReviewType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
class ReviewController extends AbstractController
{

    /**
    * @var ReviewRepository
    */
    private $repository;

    public function __construct(ReviewRepository $repository , ObjectManager $em )
    {
        $this->repository = $repository ;
        $this->em = $em;
        
    }
 
     /**
      * @Route("/admin/review", name="admin.review.index")
      * @return \Symfony\Component\HttpFoundation\Response
      */
     public function index()
     {
        $reviews = $this->repository->findAll();
        return $this->render('admin/review/index.html.twig' , compact('reviews'));
     }

      /**
     * @Route("/admin/review/create", name="admin.review.new")
     * @param Request $request
     */
    public function new(Request $request)
    {
        $review = new review();
        $form = $this->createForm(ReviewType::class , $review  );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        { $this->em->persist($review);
           $this->em->flush();
           $this->addFlash('success' , 'successfully created');
           return $this->redirectToRoute('admin.review.index') ;
        } 
       return $this->render('admin/review/new.html.twig' , [
        'review' => $review ,
        'form' => $form->createView()
    ] );
    }

     /**
     * @Route("/admin/review/{id}", name="admin.review.edit" , methods="GET|POST")
     * @param Review $review
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
     public function edit(Review $review , Request $request)
    {
        
       $form = $this->createForm(ReviewType::class , $review  );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
           $this->em->flush();
           $this->addFlash('success' , 'successfully modified');
           return $this->redirectToRoute('admin.review.index') ;
        } 


       return $this->render('admin/review/edit.html.twig' , [
           'review' => $review ,
           'form' => $form->createView()
       ]);
       
    }

    /**
     * @Route("/admin/review/{id}", name="admin.review.delete" ,  methods="DELETE")
     * @param Review $review
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Review $review , Request $request )
    {  
        $this->em->remove($review);
         $this->em->flush(); 
         $this->addFlash('success' , 'successfully deleted');
    
        
        return $this->redirectToRoute('admin.review.index') ;
        
    }
}