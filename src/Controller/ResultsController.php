<?php

namespace App\Controller;

use App\Entity\Tyre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use openApi\Annotations as OA;

class ResultsController extends AbstractController
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        
    }

    #[Route('/results', name: 'tyre_results')]
    #[OA\Tag(name: "Results")] 
    #[OA\Response(response: "200", description: "Search for tyres")]
    public function index(Request $request): Response
    {
        // dd($request);    
        $data = $request->query->get('data');
        $tyreToSearch = explode('/',$data);
        $width = $tyreToSearch[0];
        $height = $tyreToSearch[1];
        $diameter = $tyreToSearch[2];
        $season = $tyreToSearch[3];

        //search for tyres in database
        $results = $this->em->getRepository(Tyre::class)->findBy([
            'width'=>$width,
            'height'=>$height,
            'diameter'=>$diameter,
            'season'=>$season
        ]);
       
        return $this->render('results/index.html.twig', [
            'results'=>$results
        ]);
    }


    #[Route('api/cart/add', methods: ['POST'], name: 'add_to_cart')]
    #[OA\Tag(name: "Cart")]
    #[OA\Response(response: "200", description: "Add to cart")]
    public function addToCart(Request $request): Response
    {   
        // $tyreId = $request->request->get('tyre_id');
        // $quantity = $request->request->get('quantity');
        // $session = $request->getSession();
        // $tyreAndQuantity = [
        //     'tyre_id' => $tyreId,
        //     'quantity' => $quantity
        // ];
        // $session->set('cart', $tyreAndQuantity);
        return new Response('Added to cart');
    }
}
