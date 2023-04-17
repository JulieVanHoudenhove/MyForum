<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\LikedPostRepository;
use Monolog\DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/{id}', name: 'app_user_show')]
    public function show(User $user, LikedPostRepository $likedPostRepository): Response
    {
        $likedAgo = $likedPostRepository->findLastWeekLiked($user);

        // Voir nb total post
        // Voir nb total like sur poste
        // Voir nb poste 7 derniers jours
        // Voir nb like 7 derniers jours [X]
        // Voir utilisateurs poste le +

        return $this->render('user/show.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'likedAgo' => $likedAgo
        ]);
    }
}
