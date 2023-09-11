<?php

namespace App\Controller;

use App\Entity\Tyre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use openApi\Annotations as OA;

class CartController extends AbstractController
{
    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        
    }

    #[Route('/cart', name: 'cart')]
    #[OA\Tag(name: "Cart")]
    #[OA\Response(response: "200", description: "Go to cart page")]
    public function cart(Request $request): Response
    {
        $session = $request->getSession();
        $cart = $session->get('cart');
        $tyresWithQuantity = [];
        foreach ($cart as $tyre_id => $quantity) {
            $tyre = $this->em->getRepository(Tyre::class)->find($tyre_id);
            $tyresWithQuantity[] = [
                'tyre' => [
                    'id' => $tyre->getId(),
                    'brand' => $tyre->getBrand(),
                    'name' => $tyre->getName(),
                    'price' => 78.00 ,
                    'width' => $tyre->getWidth(),
                    'height' => $tyre->getHeight(),
                    'diameter' => $tyre->getDiameter(),
                    'season' => $tyre->getSeason(),
                ],
                'quantity' => $quantity
            ];
        }
                 
        return $this->render('cart.html.twig', [
            'tyresWithQuantity' => $tyresWithQuantity
        ]);
    }

    #[Route('api/remove_tyre', methods: ['GET'], name: 'cart_remove_tyre')]
    #[OA\Tag(name: "Cart")]
    #[OA\Response(response: "200", description: "Remove 1 quantity of tyre from cart or remove tyre from cart if quantity is 1")]
    public function removeTyre(Request $request): Response
    {   
        $tyreId = $request->get('tyre_id');
        $session = $request->getSession();
        $cart = $session->get('cart');
        if ($cart[$tyreId] > 1) {
            $cart[$tyreId]--;
        } else {
            unset($cart[$tyreId]);
        }
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart',[],302);
    }

    #[Route('api/add_tyre', methods: ['GET'], name: 'cart_add_tyre')]
    #[OA\Tag(name: "Cart")]
    #[OA\Response(response: "200", description: "Add 1 quantity of tyre to cart")]
    public function addTyre(Request $request): Response
    {   
        $tyreId = $request->get('tyre_id');
        $session = $request->getSession();
        $cart = $session->get('cart');
        if (isset($cart[$tyreId])) {
            $cart[$tyreId]++;
        } else {
            $cart[$tyreId] = 1;
        }
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart',[],302);
    }

    #[Route('api/delete_tyre', methods: ['GET'], name: 'cart_delete_tyre')]
    #[OA\Tag(name: "Cart")]
    #[OA\Response(response: "200", description: "Delete tyre from cart")]
    public function deleteTyre(Request $request): Response
    {   
        $tyreId = $request->get('tyre_id');
        $session = $request->getSession();
        $cart = $session->get('cart');
        unset($cart[$tyreId]);
        $session->set('cart', $cart);
        return $this->redirectToRoute('cart',[],302);
    }
}
