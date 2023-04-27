<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Service\UploaderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
class UploadPostController extends AbstractController
{
    public function __invoke(Request $request, PostRepository $postRepository, UserRepository $userRepository, UploaderService $uploaderService): ?Post
    {
        $post = new Post();
        $user = $userRepository->findOneBy(['id' => $request->get('user')]);

        $postFile = $request->files->get('file');

        $post->setTitle($request->get('title'));
        $post->setText($request->get('text'));
        $post->setUser($user);

        if ($postFile) {
            $filename = $uploaderService->uploadImage($postFile, UploaderService::POST);
            $post->setImage($filename);
        }

            return $post;
        }
}
