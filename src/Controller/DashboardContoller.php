<?php

namespace App\Controller;

use App\Entity\Run;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class DashboardContoller extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    /**
     * DashboardContoller constructor.
     * @param Security $security
     */
    public function __construct(Security $security) {
        $this->security = $security;
    }

    /**
     * @Route("/dashboard", name="dashboard")
     */
    public function index(): Response
    {
        /**
         * @var User
         */
        $user = $this->security->getUser();
        /**
         * @var $run Run
         */
        $runs = $user->getRuns()->map(function($run) {
            return $run->getFormatedData();
        });

        return $this->render('dashboard.html.twig', [
            'runs' => $runs,
        ]);
    }
}
