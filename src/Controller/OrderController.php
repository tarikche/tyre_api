<?php

namespace App\Controller;

use App\Entity\Order;
use App\Entity\OrderLine;
use App\Entity\Tyre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AddressForm;
class OrderController extends AbstractController
{

    private EntityManagerInterface $em;
    
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        
    }

    #[Route('/order/address', name: 'order_add_address')]
    public function createOrder(Request $request): Response
    {
        $form = $this->createForm(AddressForm::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Process the submitted address here (e.g., save it to the database)
            $formData = $form->getData();
            // Redirect or render a success page
            return $this->redirectToRoute('confirm_order',[
                'data' => $formData
            ],302);
        }

        return $this->render('address_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/order/confirm', name: 'confirm_order')]
    public function confirmOrder(Request $request): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $session = $request->getSession();
        $cart = $session->get('cart');
        if (!$cart) {
            return $this->redirectToRoute('home');
        };
        $finalPrice = 0 ;
        $newOrder = new Order();
        $orderlines = [];
        foreach ($cart as $tyre_id => $quantity) {
            $tyre = $this->em->getRepository(Tyre::class)->find($tyre_id);
            $tyrePrice = $tyre->getPrice();
            $totalPrice = $tyrePrice * $quantity;
            $finalPrice += $totalPrice;
            $newOrderLine = new OrderLine();
            $newOrderLine->addTyre($tyre);
            $newOrderLine->setQuantity($quantity);
            $newOrderLine->setTotalPrice($totalPrice);
            $newOrderLine->setOrderId($newOrder);
            $this->em->persist($newOrderLine);
            $newOrder->addOrderLine($newOrderLine);
            
        }

        $newOrder->setUser($this->getUser());
        $newOrder->setOrderDate(new \DateTime());
        $newOrder->setTotalPrice($finalPrice);
        $this->em->persist($newOrder);
        $this->em->flush();
        // $session->remove('cart');

        return $this->render('order_confirmed.html.twig', [
            
        ]);
    }
    
}
