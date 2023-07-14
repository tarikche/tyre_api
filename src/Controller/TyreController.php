<?php

namespace App\Controller;

use App\Entity\Tyre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;

class TyreController extends AbstractController
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        
    }

    #[Route('/api/tyre/search/{value}  ', name: 'tyre_search')]
    public function searchTyre($value): Response   
    {
       
        $result = $this->em->getRepository(Tyre::class)->searchTyreByAll($value);
        
    
        
        
        $data = [];

        foreach ($result as $item) {
            // Convert each entity to an associative array
            $data[] = [
               $item->getBrand()
                // Add more fields as needed
            ];
        }

        return new JsonResponse($data);
        

    }
}
