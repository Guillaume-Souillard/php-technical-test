<?php

namespace App\Controller\Forms;

use App\Entity\Run;
use App\Traits\Converter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class RunContoller extends AbstractController
{
    use Converter;
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
     * @Route("/dashboard/run/create", name="create_run")
     */
    public function create(Request $request): Response
    {
        $run = new Run();
        $run->setUid($this->security->getUser());

        return $this->execute($request, $run);
    }

    /**
     * @Route("/dashboard/run/{id}/edit", name="edit_run")
     */
    public function edit(Request $request, $id): Response
    {
        if ($run = $this->getDoctrine()->getRepository(Run::class)->find($id)) {
            if ($run->getUid() === $this->security->getUser()) {
                return $this->execute($request, $run, true);
            }

            return new Response('unauthorised', 401);
        }

        return new Response('Run not found', 404);
    }

    /**
     * @Route("/dashboard/run/{id}/delete", name="delete_run")
     */
    public function delete(Request $request, $id): Response
    {
        /**
         * @var $run Run
         */
        if ($run = $this->getDoctrine()->getRepository(Run::class)->find($id)) {
            if ($run->getUid() === $this->security->getUser()) {

                $em = $this->getDoctrine()->getManager();
                $em->remove($run);
                $em->flush();

                return $this->redirectToRoute('dashboard');
            }
            return new Response('unauthorised', 401);
        }

        return new Response('Run not found', 404);
    }

    /**
     * @param Request $request
     * @param Run $run
     * @param false $edit
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    private function execute(Request $request, Run $run, $edit = false) {
        $form = $this->createForm(\App\Form\RunType::class, $run);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $run->setAverageSpeed($this->meterPerSecondIntoKilometerPerHour($run->getDistance() / $run->getDuration()));
            $run->setAveragePace($this->secondPerMeterIntoMinutePerKilometer($run->getDuration() / $run->getDistance()));

            $em = $this->getDoctrine()->getManager();
            $em->persist($run);
            $em->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('forms/run.html.twig', [
            'form' => $form->createView(),
            'edit' => $edit,
        ]);
    }
}
