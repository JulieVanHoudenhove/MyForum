<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\LikedPost;
use App\Entity\Post;
use App\Form\CommentType;
use App\Form\PostType;
use App\Repository\CommentRepository;
use App\Repository\LikedPostRepository;
use App\Repository\PostRepository;
use App\Service\PostService;
use App\Service\UploaderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index')]
    public function index(PostService $postService): Response
    {
        $this->getUser() ? $currentUser = $this->getUser() : $currentUser = null;
        $posts = $postService->getPostsByDate(25, $currentUser);

        return $this->render('post/index.html.twig',
            [
                'controller_name' => 'PostController',
                'posts' => $posts
            ]);
    }

    #[Route('/new', name: 'app_post_new')]
    public function new(PostRepository $postRepository, Request $request, UploaderService $uploaderService): Response
    {
        if ($this->getUser() == null) {
            return $this->redirectToRoute('app_login');
        }

        $post = new Post();

        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $postFile = $form->get('imageFile')->getData();

            if ($postFile) {
                $filename = $uploaderService->uploadImage($postFile, UploaderService::POST);
                $post->setImage($filename);
            }

            $post->setUser($this->getUser());
            $postRepository->save($post, true);

            return $this->redirectToRoute('app_post_index');
        }

        return $this->render('post/new.html.twig',
            [
                'controller_name' => 'PostController',
                'post' => $post,
                'form' => $form
            ]);
    }

    #[Route('/{id}', name: 'app_post_show')]
    public function show(Post $post, Request $request, CommentRepository $commentRepository, PostService $postService): Response
    {
        $this->getUser() ? $currentUser = $this->getUser() : $currentUser = null;
        $data = $postService->RenderSinglePost($post, $currentUser);

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setUser($this->getUser())
                ->setPost($post);
            $commentRepository->save($comment, true);

            unset($comment);
            unset($form);
            $comment = new Comment();
            $form = $this->createForm(CommentType::class, $comment);

            $data = $postService->RenderSinglePost($post, $currentUser);
        }

        return $this->render('post/show.html.twig',
            [
                'controller_name' => 'PostController',
                'post' => $data[0],
                'form' => $form,
                'comment' => $comment,
                'comments' => $data[1]
            ]);
    }

    #[Route('/{id}/like', name: 'app_post_like')]
    public function like(Post $post, LikedPostRepository $likedPostRepository, Request $request): Response
    {
        $id = $post->getId();
        $redirect = $request->query->get('redirect');

        if ($this->getUser() == null) {
            return $this->redirectToRoute('app_login');
        }

        $likedPost = new LikedPost();

        if ($likedPostRepository->findOneBy(['post' => $post, 'user' => $this->getUser()])) {
            $this->redirectPost($redirect, $id);
        }

        $likedPost->setPost($post);
        $likedPost->setUser($this->getUser());
        $likedPostRepository->save($likedPost, true);

        return $this->redirectPost($redirect, $id);
    }

    #[Route('/{id}/dislike', name: 'app_post_dislike')]
    public function dislike(Post $post, LikedPostRepository $likedPostRepository, Request $request): Response
    {
        $id = $post->getId();
        $redirect = $request->query->get('redirect');

        if ($this->getUser() == null) {
            return $this->redirectToRoute('app_login');
        }

        if (!$likedPostRepository->findOneBy(['post' => $post, 'user' => $this->getUser()])) {
            $this->redirectPost($redirect, $id);
        }

        $likedPost = $likedPostRepository->findOneBy(['post' => $post, 'user' => $this->getUser()]);
        $likedPostRepository->remove($likedPost, true);
        return $this->redirectPost($redirect, $id);
    }

    #[Route('/{id}/remove', name: 'app_post_remove')]
    public function remove(PostRepository $postRepository, Post $post): Response
    {
        if ($post->getImage() !== null) {
            $filesystem = new Filesystem();
            $oldFile = $post->getImage();
            $path = $this->getParameter('post_img_directory') . '/' . $oldFile;
            $filesystem->remove($path);
        }

        $postRepository->remove($post, true);
        return $this->redirectToRoute('app_home');
    }

    private function redirectPost($redirect, $id): RedirectResponse
    {
        if ($redirect == 'post') {
            return $this->redirectToRoute('app_post_show', ['id' => $id]);
        } else {
            return $this->redirectToRoute('app_home');
        }
    }
}
