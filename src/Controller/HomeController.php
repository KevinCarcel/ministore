<?php
  namespace App\Controller;
  
  use App\Repository\LogoRepository;
  use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
  use Symfony\Component\Routing\Annotation\Route;
  use Symfony\Component\HttpFoundation\Response;

  

  class HomeController extends AbstractController
  {
    #[Route('/','home.index',methods: ['GET'])]
    public function index(LogoRepository $logoRepository):Response
    {
      $logo = $logoRepository->findOneBy([]);
      return $this->render("home.html.twig",['logo'=>$logo]);
    }
  }

?>