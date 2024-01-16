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

        $panier = $session->get('panier', []);

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

        $this->addFlash('message', 'commande créée avec succès'); 
        // Redirigez l'utilisateur vers la page de commande en cours
        // l'ID de la commande à cette page pour récupérer les détails de la commande
        return $this->redirectToRoute('app_orders_summary', ['orderId' => $order->getId()]);

    }
    
  #[Route("/order-summary/{orderId}", name: "summary")]
public function orderSummary($orderId, OrdersRepository $ordersRepository)
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

    // Passez les détails de la commande à la vue
    return $this->render('orders/order_summary.html.twig', [
        'order' => $order,
        'orderDetails' => $orderDetails,
        'adresseLivraison1' => $adresseLivraison1,
        'adresseLivraison2' => $adresseLivraison2
    ]);
}

}