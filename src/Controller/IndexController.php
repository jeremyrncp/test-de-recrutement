<?php

namespace App\Controller;

use App\Repository\FilmRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(Request $request, FilmRepository $filmRepository): Response
    {
        $searchTerm = $request->query->get('q');

        if ($request->query->get('preview')) {
            return $this->render('index/search_preview.html.twig', [
                'films' => $filmRepository->findByGenreOrName($searchTerm)
            ]);
        }

        return $this->render('index/index.html.twig', [
            'searchTerm' => $request->query->get('q')
        ]);
    }
}
