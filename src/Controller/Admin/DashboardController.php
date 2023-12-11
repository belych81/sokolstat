<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use App\Entity\Player;
use App\Entity\City;
use App\Entity\Country;
use App\Entity\Referee;
use App\Entity\Team;
use App\Entity\Mundial;
use App\Entity\Amplua;
use App\Entity\Stadia;
use App\Entity\Turnir;
use App\Entity\Transfer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');

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
            ->setTitle('Sokolstat');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            //MenuItem::section('Blog'),
            MenuItem::linkToCrud('Game', 'fa fa-tags', Game::class),
            MenuItem::linkToCrud('Mundial', 'fa fa-file-text', Player::class),
            MenuItem::linkToCrud('Player', 'fa fa-file-text', Player::class),

            MenuItem::linkToCrud('City', 'fa fa-comment', City::class),
            MenuItem::linkToCrud('Country', 'fa fa-user', Country::class),
            MenuItem::linkToCrud('Referee', 'fa fa-comment', Referee::class),
            MenuItem::linkToCrud('Team', 'fa fa-user', Team::class),
            MenuItem::linkToCrud('Amplua', 'fa fa-comment', Amplua::class),
            MenuItem::linkToCrud('Stadia', 'fa fa-user', Stadia::class),
            MenuItem::linkToCrud('Turnir', 'fa fa-comment', Turnir::class),
            MenuItem::linkToCrud('Transfer', 'fa fa-user', Transfer::class),
        ];
        //yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
