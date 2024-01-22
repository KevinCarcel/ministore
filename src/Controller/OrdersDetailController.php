<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class OrdersDetailController extends AbstractController
{
    /**
     * @Route("/ordersdetail", name="orders_detail")
     */
    public function index()
    {
        return $this->render('orders_detail/index.html.twig', [
            'controller_name' => 'OrdersDetailController',
        ]);
    }
}