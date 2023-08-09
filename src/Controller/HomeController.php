<?php

namespace App\Controller;

use App\Entity\Tyre;
use App\Form\SearchTyreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\Cloner\Data;

class HomeController extends AbstractController
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        
    }

    #[Route('/home', name: 'home')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(SearchTyreType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Process the form data and do something with it if needed
            
            $data = $form->getData();
            

            $tyreToSearch=sprintf('%s/%s/%s/%s',$data->getWidth(),$data->getHeight(),$data->getDiameter(),$data->getSeason());

            // ...
            
            return $this->redirectToRoute('tyre_results',[
                'data' => $tyreToSearch
            ],302);
        }
        
        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            
        ]);
    }
}
