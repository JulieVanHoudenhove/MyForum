<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\LikedPostRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Monolog\DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/{id}', name: 'app_user_show')]
    public function show(User $user, LikedPostRepository $likedPostRepository, UserRepository $userRepository, PostRepository $postRepository): Response
    {
        $lastWeekLike = $likedPostRepository->countLastWeekLike($user);
        $totalPost = $postRepository->countTotalPost($user);
        $lastWeekPost = $postRepository->countLastWeekPost($user);
        $totalLike = $likedPostRepository->countTotalLike($user);
        $mostActiveUsers = $userRepository->findMostActiveUser();

        // Voir nb total post
        // Voir nb total like sur poste
        // Voir nb poste 7 derniers jours
        // Voir nb like 7 derniers jours [X]
        // Voir utilisateurs poste le +

        return $this->render('user/show.html.twig', [
            'controller_name' => 'UserController',
            'user' => $user,
            'lastWeekLike' => $lastWeekLike,
            'lastWeekPost' => $lastWeekPost,
            'totalPost' => $totalPost,
            'totalLike' => $totalLike,
            'mostActiveUsers' => $mostActiveUsers
        ]);
    }
}
