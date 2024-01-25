<?php
namespace App\Controller;

use App\Entity\Produit;
use App\Repository\ProduitRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/cart', name: 'cart_')] 
class CartController extends AbstractController
{
  #[Route('/', name: 'index')]
    public function index(SessionInterface $session, ProduitRepository $produitRepository)
    {
      if (!$this->getUser()) {
        return $this->redirectToRoute('app_login');
      }
      $panier=$session->get('panier', []);

      //on initialise des variables 
      $data = [];
      $total = 0;
      
      foreach($panier as $id => $quantity){
        $produit = $produitRepository->find($id);

        $data[]=[
          'produit' => $produit,
          'quantity' => $quantity
        ];
        $total += $produit->getPrix() * $quantity;
      }
      return $this->render('cart/index.html.twig',  compact('data', 'total'));
    }



    #[Route('/add/{id}', name: 'add')]
    public function add(Produit $produit, SessionInterface $session, int $id , Request $request)
  {
    //on recupere l'id du produit
    $id=$produit->getId();

    //on recupere le panier existant
    $panier = $session->get('panier', []);

     //on recupere la quantite du produit choisi par le user
     $quantity = $request->request->get('quantity', 1);
     
    //on ajoute le produit au panier si il n'est pas deja dedans
    //sinon on augmente la quantité
    if(empty($panier[$id])){
      $panier[$id]= $quantity;
    }else{
      $panier[$id]=$quantity;
    }


    $session->set('panier', $panier);

    //On redirige vers la page du panier
    return $this->redirectToRoute('cart_index');
  }

  #[Route('/remove/{id}', name: 'remove')]
    public function remove(Produit $produit, SessionInterface $session, int $id)
  {
    //on recupere l'id du produit
    $id=$produit->getId();

    //on recupere le panier existant
    $panier = $session->get('panier', []);

    //on retire le produit du panier si il n'y a qu'un exemplaire
    //sinon on décrémente la quantité
    if(!empty($panier[$id])){
      if($panier[$id] > 1){
        $panier[$id]--;
    }else{
      unset($panier[$id]);
    }
  }


    $session->set('panier', $panier);

    //On redirige vers la page du panier
    return $this->redirectToRoute('cart_index');
  }

  #[Route('/delete/{id}', name: 'delete')]
    public function delete(Produit $produit, SessionInterface $session, int $id)
  {
    //on recupere l'id du produit
    $id=$produit->getId();

    //on recupere le panier existant
    $panier = $session->get('panier', []);

    if(!empty($panier[$id])){
      unset($panier[$id]);
    }


    $session->set('panier', $panier);

    //On redirige vers la page du panier
    return $this->redirectToRoute('cart_index');
  }

  #[Route('/empty', name: 'empty')]
    public function empty(SessionInterface $session)
  {
    $session->remove('panier');

    //On redirige vers la page du panier
    return $this->redirectToRoute('cart_index');
  }
}

 ?>