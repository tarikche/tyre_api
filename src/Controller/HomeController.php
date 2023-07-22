<?php

namespace App\Controller;

use App\Form\SearchTyreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\Cloner\Data;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(Request $request): Response
    {
            $form = $this->createForm(SearchTyreType::class);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // Process the form data and do something with it if needed
                $data = $form->getData();
                
                // ...
                
                return $this->redirectToRoute('tyre_results',[
                    'data' => $data->getSeason()
                ],302);
            }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
