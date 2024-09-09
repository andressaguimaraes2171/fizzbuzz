<?php

namespace App\Controller;

use App\Form\FizzBuzzType;
use App\Service\ArrayPaginatorService;
use App\Service\FizzBuzzService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(Request $request, FizzBuzzService $fizzBuzzService, ArrayPaginatorService $paginatorService): Response
    {

        $form = $this->createForm(FizzBuzzType::class);
        $form->handleRequest($request);
        $result = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $result = $fizzBuzzService->generateFizzBuzz(
                $data['from'],
                $data['to'],
                $data['fizzNumber'],
                $data['buzzNumber']
            );

            $result = $paginatorService->paginate($result, $data['page'], 20);
        }

        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
            'form' => $form->createView(),
            'result' => $result
        ]);
    }
}
