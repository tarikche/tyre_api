<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultsController extends AbstractController
{
    #[Route('/results', name: 'tyre_results')]
    public function index(Request $request): Response
    {
        $data = $request->query->get('data');
        
        

        return $this->render('results/index.html.twig', [
            'data'=>$data
        ]);
    }
}
