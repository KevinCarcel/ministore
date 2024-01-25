<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\TypeRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/produit')]
class ProduitController extends AbstractController
{
    #[Route('/', name: 'app_produit_index', methods: ['GET'])]
    public function index(ProduitRepository $produitRepository, Request $request, TypeRepository $typeRepository): Response
    {
        $nom = $request->query->get('nom');
        $typeId = $request->query->get('type');
        $order = $request->query->get('order');
        
    if ($typeId && $nom) {
        $type = $typeRepository->find($typeId);
        $produits = $produitRepository->findByTypeAndName($type, $nom, $order);
    } elseif ($typeId) {
        $type = $typeRepository->find($typeId);
        $produits = $produitRepository->findByType($type, $order);
    } elseif ($nom) {
        $produits = $produitRepository->findByName($nom, $order);
    } else {
        $produits = $produitRepository->findAll($order);
    }
        $types = $typeRepository->findAll();
        return $this->render('produit/index.html.twig', [
            'produits' => $produits,
            'types' => $types,
        ]);
    }


    #[Route('/{id}', name: 'app_produit_show', methods: ['GET'])]
    public function show(Produit $produit): Response
    {
        return $this->render('produit/show.html.twig', [
            'produit' => $produit,
        ]);
    }
    // public function configureFilters(Filters $filters): Filters
    // {
    //     return $filters
    //         ->add('type')
    //         ->add('price')
    //         ->add('nom')
    //     ;
    // }
}