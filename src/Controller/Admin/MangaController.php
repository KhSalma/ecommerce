<?php
namespace App\Controller\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MangaRepository;
use App\Entity\Manga;
use App\Form\MangaType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
class MangaController extends AbstractController
{
 /**
    * @var MangaRepository
    */
    private $repository;

    public function __construct(MangaRepository $repository , ObjectManager $em )
    {
        $this->repository = $repository ;
        $this->em = $em;
        
    }
 
     /**
      * @Route("/admin/manga", name="admin.manga.index")
      * @return \Symfony\Component\HttpFoundation\Response
      */
     public function index()
     {
        $mangas = $this->repository->findAll();
        return $this->render('admin/manga/index.html.twig' , compact('mangas'));
     }

     /**
     * @Route("/admin/manga/create", name="admin.manga.new")
     * @param Request $request
     */
    public function new(Request $request)
    {
        $manga = new Manga();
        $form = $this->createForm(MangaType::class , $manga  );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        { $this->em->persist($manga);
           $this->em->flush();
           $this->addFlash('success' , 'successfully created');
           return $this->redirectToRoute('admin.manga.index') ;
        } 
       return $this->render('admin/manga/new.html.twig' , [
        'manga' => $manga ,
        'form' => $form->createView()
    ] );
    }

     /**
     * @Route("/admin/manga/{id}", name="admin.manga.edit" , methods="GET|POST")
     * @param Manga $manga
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
     public function edit(Manga $manga , Request $request)
    {
        
       $form = $this->createForm(MangaType::class , $manga  );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
           $this->em->flush();
           $this->addFlash('success' , 'successfully modified');
           return $this->redirectToRoute('admin.manga.index') ;
        } 


       return $this->render('admin/manga/edit.html.twig' , [
           'manga' => $manga ,
           'form' => $form->createView()
       ]);
       
    }

    /**
     * @Route("/admin/manga/{id}", name="admin.manga.delete" ,  methods="DELETE")
     * @param Manga $manga
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete(Manga $manga , Request $request )
    {  
        $this->em->remove($manga);
         $this->em->flush(); 
         $this->addFlash('success' , 'successfully deleted');
    
        
        return $this->redirectToRoute('admin.manga.index') ;
        
    }
}