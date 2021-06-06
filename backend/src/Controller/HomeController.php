<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route(path={"/", "/weather/{id}"}, name="front")
     */
    public function index(): Response
    {
        return $this->render('home/front.html.twig');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function admin(): Response
    {
        return $this->render('home/admin.html.twig');
    }
}
