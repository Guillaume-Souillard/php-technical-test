<?php

namespace App\Controller;

use App\Entity\Run;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api/runs/all", name="api_all_runs")
     */
    public function all(): Response
    {
        $data = [];
        /**
         * @var $run Run
         */
        foreach ($this->getDoctrine()->getRepository(Run::class)->findAll() as $run) {
            $data[] = $run->getApiFormatedData();
        }

        return new JsonResponse($data, 200);
    }

    /**
     * @Route("/api/run/{id}", name="api_one_run")
     */
    public function one($id): Response
    {
        /**
         * @var $run Run
         */
        if($run = $this->getDoctrine()->getRepository(Run::class)->find($id)) {
            return new JsonResponse($run->getApiFormatedData(), 200);
        }

        return new JsonResponse('Not found', 404);
    }

    /**
     * @Route("/api/runs/all/user/{id}", name="api_one_run_user")
     */
    public function allOfUser($id): Response
    {
        /**
         * @var $user User
         */
        if ($user = $this->getDoctrine()->getRepository(User::class)->find($id)) {
            /**
             * @var $run Run
             */
            $runs =  $user->getRuns()->map(function ($run) {
                return $run->getApiFormatedData();
            });

            return new JsonResponse($runs->toArray(), 200);
        }

        return new JsonResponse('Not found', 404);
    }
}
