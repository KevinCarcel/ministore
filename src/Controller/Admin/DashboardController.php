<?php

namespace App\Controller\Admin;

use App\Entity\Nav;
use App\Entity\Logo;
use App\Entity\Type;
use App\Entity\User;
use App\Entity\Orders;
use App\Entity\Produit;
use App\Entity\OrdersDetails;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // Render the custom dashboard template
         return $this->render('admin/dashboard.html.twig');
        // $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        // $url = $routeBuilder->setController(ProduitCrudController::class)->generateUrl();

        // return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ministore');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fas fa-home');
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-solide fa-backward', 'home.index');
        yield MenuItem::linkToCrud('Produit', 'fas fa-solid fa-store', Produit::class);
        yield MenuItem::linkToCrud('Type', 'fas fa-solid fa-list', Type::class);
        yield MenuItem::linkToCrud('User', 'fas fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Logo', 'fas fa-solid fa-image', Logo::class);
        yield MenuItem::linkToCrud('Orders', 'fas fa-solid fa-truck-fast', Orders::class);
        yield MenuItem::linkToCrud('Nav', 'fas fa-solid fa-list', Nav::class);
        yield MenuItem::linkToRoute('logout', 'fas fa-solid fa-sign-out-alt', 'app_logout');
    }
    
}