<?php
namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface ;
class CategoryController extends AbstractController
{
/**
    * @var MangaRepository
    */
    private $repository;

    public function __construct(CategoryRepository $repository , ObjectManager $em )
    {
        $this->repository = $repository ;
        $this->em = $em;
        
    }
 
     /**
      * @Route("/admin/category", name="admin.category.index")
      * @return \Symfony\Component\HttpFoundation\Response
      */
     public function index(PaginatorInterface $paginator  , Request $request)
     {  
        $categories=$paginator->paginate(
            $this->repository->findAllCat() , 
            $request->query->getInt('page', 1),
            4
       );
        //$categories = $this->repository->findAll();
        return $this->render('admin/category/index.html.twig' , compact('categories'));
     }

     /**
     * @Route("/admin/category/create", name="admin.category.new")
     * @param Request $request
     */
    public function new(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class , $category  );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        { $this->em->persist($category);
           $this->em->flush();
           $this->addFlash('success' , 'successfully created');
           return $this->redirectToRoute('admin.category.index') ;
        } 
       return $this->render('admin/category/new.html.twig' , [
        'category' => $category ,
        'form' => $form->createView()
    ] );
    }

     /**
     * @Route("/admin/category/{id}", name="admin.category.edit" , methods="GET|POST")
     * @param Category $category
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
     public function edit(Category $category , Request $request )
    {
        
       $form = $this->createForm(CategoryType::class , $category  );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
           $this->em->flush();
           $this->addFlash('success' , 'successfully modified');
           return $this->redirectToRoute('admin.category.index') ;
        } 


       return $this->render('admin/category/edit.html.twig' , [
           'category' => $category ,
           'form' => $form->createView()
       ]);
       
    }

    /**
     * @Route("/admin/category/{id}", name="admin.category.delete" ,  methods="DELETE")
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Category $category , Request $request )
    {  
        $this->em->remove($category);
         $this->em->flush(); 
         $this->addFlash('success' , 'successfully deleted');
    
        
        return $this->redirectToRoute('admin.category.index') ;
        
    }

    
    
}