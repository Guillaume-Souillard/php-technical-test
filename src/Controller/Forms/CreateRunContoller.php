<?php

namespace App\Controller\Forms;

use App\Entity\Run;
use App\Entity\RunType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class CreateRunContoller extends AbstractController
{
    /**
     * @var Security
     */
    private $security;

    /**
     * CreateRunContollerController constructor.
     * @param Security $security
     */
    public function __construct(Security $security) {
        $this->security = $security;
    }

    /**
     * @Route("/dashboard/run/create", name="forms_create_run")
     */
    public function index(Request $request): Response
    {
        $run = new Run();
        $run->setUid($this->security->getUser());
        $form = $this->createForm(\App\Form\RunType::class, $run);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($run);
            $em->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('forms/create_run.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
