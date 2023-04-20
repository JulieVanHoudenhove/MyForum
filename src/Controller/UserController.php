<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AvatarType;
use App\Repository\LikedPostRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Service\UploaderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

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

    #[Route('/{id}/edit', name: 'app_user_edit')]
    public function edit(User $user, Request $request, UserRepository $userRepository, UploaderService $uploaderService)
    {
        if (!$this->getUser() || $this->getUser() != $user) {
            return $this->redirectToRoute('app_post_index');
        }

        $form = $this->createForm(AvatarType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $avatarFile = $form->get('avatarFile')->getData();

            if ($avatarFile) {
                if($user->getAvatar() != null) {
                    $filesystem = new Filesystem();
                    $oldFile = $user->getAvatar();
                    $path = $this->getParameter('avatars_directory').'/'.$oldFile;
                    $filesystem->remove($path);
                }

                $filename = $uploaderService->uploadImage($avatarFile, UploaderService::AVATAR);
                $user->setAvatar($filename);
                $userRepository->save($user, true);
            }

            return $this->redirectToRoute('app_user_show', ['id' => $user->getId()]);
        }

        return $this->render('user/new.html.twig', [
            'form' => $form,
            'user' => $user
        ]);
    }
}
