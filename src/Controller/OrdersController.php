<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Entity\OrdersDetails;
use App\Repository\OrdersRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/commandes', name: 'app_orders_')]
class OrdersController extends AbstractController
{
    #[Route('/ajout', name: 'add')]
    public function add(SessionInterface $session, ProduitRepository $produitRepository, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        // Vérifiez si un utilisateur est connecté
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifiez si le panier est vide
        $panier = $session->get('panier', []);

        // Si le panier est vide, redirigez l'utilisateur vers la page d'accueil
        if($panier === []){
            $this->addFlash('message', 'Votre panier est vide');
            return $this->redirectToRoute('home.index');
        }
        
        //Le panier n'est pas vide, on crée une commande
        $order = new Orders();

        //on remplit la commande
        $order->setUser($this->getUser());
        $order->setReference(uniqid());

        //on parcourt le panier pour créer les détails de la commande
        foreach($panier as $item => $quantity){
            $orderDetails = new OrdersDetails();

            //on va chercher le produit
            $produit = $produitRepository->find($item);

            // On diminue le stock du produit de la quantité dans le panier
            $produit->setStock($produit->getStock() - $quantity);
            
            $prix = $produit->getPrix();
            
            //On creer le detail de la commande
            $orderDetails->setProduits($produit)
                         ->setPrix($prix)
                         ->setQuantity($quantity);
            
            $order->addOrdersDetail($orderDetails);
        }
        //On persiste et on flush
        $em->persist($order);
        $em->flush();

        //On vide le panier
        $session->remove('panier');

        $this->addFlash('message', 'commande créée avec succès'); 
        // Redirigez l'utilisateur vers la page de commande en cours
        // l'ID de la commande à cette page pour récupérer les détails de la commande
        return $this->redirectToRoute('app_orders_delivery', ['orderId' => $order->getId()]);

    }
    
  #[Route("/order-delivery/{orderId}", name: "delivery")]
public function orderSummary($orderId, OrdersRepository $ordersRepository , Request $request, EntityManagerInterface $em)
{
    $user = $this->getUser(); // Récupère l'utilisateur actuellement connecté
    $numVoie = $user->getNumVoie();
    $Voie = $user->getVoie();
    $ville = $user->getVille();
    $codePostal = $user->getCodePostal();
    $adresseLivraison1 = $numVoie . ' ' . $Voie ;
    $adresseLivraison2 = $ville . ' ' . $codePostal;
    // Récupérez la commande de la base de données
    $order = $ordersRepository->find($orderId);

    if (!$order) {
        throw $this->createNotFoundException('La commande demandée n\'existe pas.');
    }

    // Récupérez les détails de la commande
    $orderDetails = $order->getOrdersDetails();

    // Récupérez l'adresse de livraison de la requête
    $name = $request->query->get('name');
    $address = $request->query->get('address');
    $postalCode = $request->query->get('postalCode');
    $city = $request->query->get('city');
    $deliveryAdress = $request->query->get('deliveryAdress');
    
    // Enregistrez les modifications dans la base de données
    if ($name && $address && $postalCode && $city) {
      $deliveryAdress = $name . ', ' . $address . ', ' . $postalCode . ', ' . $city;
      $order->setDeliveryAdress($deliveryAdress);
      $em->persist($order);
      $em->flush();
  }
    
    // Passez les détails de la commande à la vue
    return $this->render('orders/order_delivery.html.twig', [
        'order' => $order,
        'orderDetails' => $orderDetails,
        'adresseLivraison1' => $adresseLivraison1,
        'adresseLivraison2' => $adresseLivraison2,
        'codePostal' => $codePostal,
        'ville' => $ville,
        'deliveryAdress' => $deliveryAdress ?? null
    ]);
}
#[Route('/order-summary/{orderId}', name: 'summary' , methods: ['GET'])]
   
  public function showOrderDetail($orderId , OrdersRepository $ordersRepository , Request $request ,EntityManagerInterface $em): Response
  {
    // Récupérez la commande de la base de données
    $order = $ordersRepository->find($orderId);

    // Récupérez les détails de la commande
    $orderDetails = $order->getOrdersDetails();

    // Récupérez l'adresse de livraison de la requête
    $name = $request->query->get('name');
    $address = $request->query->get('address');
    $postalCode = $request->query->get('postalCode');
    $city = $request->query->get('city');
    
    // Enregistrez les modifications dans la base de données
    if ($name && $address && $postalCode && $city) {
      $deliveryAdress = $name . ', ' . $address . ', ' . $postalCode . ', ' . $city;
      $order->setDeliveryAdress($deliveryAdress);
      $em->persist($order);
      $em->flush();

    }

    // Renvoyer la vue du récapitulatif de commande avec les informations de la commande
    return $this->render('orders/order_summary.html.twig', [
      'order' => $order,
      'orderDetails' => $orderDetails,
      'deliveryAdress' => $deliveryAdress ?? null
    ]);
  }

  #[Route('/order-all', name: 'all')]
public function allOrder( OrdersRepository $ordersRepository): Response
  {
    $user = $this->getUser(); // Récupère l'utilisateur actuellement connecté
    $orders = $ordersRepository->findBy(['user' => $user], ['id' => 'DESC']);
   
    $ordersWithDetails = [];
    foreach ($orders as $order) {
        $details = $order->getOrdersDetails(); // Récupère les détails de la commande
        $ordersWithDetails[] = [
            'order' => $order,
            'details' => $details
        ];
    }
   
    return $this->render('orders/order_all.html.twig', [
      'ordersWithDetails' => $ordersWithDetails,

    ]);
  }
}