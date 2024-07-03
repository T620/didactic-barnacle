<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class IndexController
{
    // add route
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        // test!
        return new Response('Hello, world!');
    }
}