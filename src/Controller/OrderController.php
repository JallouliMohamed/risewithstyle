<?php


namespace App\Controller;


use App\Entity\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OrderController extends AbstractController
{
    public function listPaymentOrder()
    {
        $orders = $this->getDoctrine()->getRepository(Order::class)->findPaymentOrder();
        return $this->render('backOffice/manageOrders.html.twig', [
            "orders" => $orders,
        ]);

    }
}