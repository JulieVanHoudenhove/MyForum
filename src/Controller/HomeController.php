<?php

namespace App\Controller;

use App\Service\PostService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('', name: 'app_home')]
    public function index(PostService $postService): Response
    {
        $this->getUser() ? $currentUser = $this->getUser(): $currentUser = null;
        $posts = $postService->getPostsByDate(25, $currentUser);

        return $this->render('home/index.html.twig', [
            'posts' => $posts
        ]);
    }
}
