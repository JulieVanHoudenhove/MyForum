<?php

namespace App\Controller;

use App\Dto\PostDtoTransformer;
use App\Entity\Comment;
use App\Entity\LikedPost;
use App\Entity\Post;
use App\Form\CommentType;
use App\Form\PostType;
use App\Repository\CommentRepository;
use App\Repository\LikedPostRepository;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index')]
    public function index(PostDtoTransformer $postDtoTransformer, PostRepository $postRepository): Response
    {
        $posts = $postRepository->findOrderDate();

        if ($this->getUser()) {
            $results = $postDtoTransformer->transformFromObjects($posts, $this->getUser());
        } else {
            $results = $posts;
        }

        return $this->render('post/index.html.twig',
        [
            'controller_name' => 'PostController',
            'posts' => $results
        ]);
    }

    #[Route('/new', name: 'app_post_new')]
    public function new(PostRepository $postRepository, Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $post->setUser($this->getUser());
            $post->setDate(new \DateTimeImmutable('now'));
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
    public function show(Post $post, Request $request, CommentRepository $commentRepository, PostDtoTransformer $postDtoTransformer): Response
    {
        if ($this->getUser()) {
            $result = $postDtoTransformer->transformFromObject($post, $this->getUser());
        } else {
            $result = $post;
        }

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $comment->setDate(new \DateTimeImmutable('now'));
            $comment->setUser($this->getUser());
            $comment->setPost($post);
            $commentRepository->save($comment, true);

            // Reset the comment form
            unset($comment);
            unset($form);
            $comment = new Comment();
            $form = $this->createForm(CommentType::class, $comment);
        }

        return $this->render('post/show.html.twig', 
        [
            'controller_name' => 'PostController',
            'post' => $result,
            'form' => $form,
            'comment' => $comment
        ]);
    }

    #[Route('/{id}/like', name: 'app_post_like')]
    public function like(Post $post, LikedPostRepository $likedPostRepository): Response
    {
        $likedPost = new LikedPost();

        if ($likedPostRepository->findOneBy(['post'=>$post, 'user'=>$this->getUser()])) {
            return $this->redirectToRoute('app_post_index');
        }

        $likedPost->setPost($post);
        $likedPost->setUser($this->getUser());
        $likedPost->setDate(new \DateTimeImmutable('now'));
        $likedPostRepository->save($likedPost, true);
        return $this->redirectToRoute('app_post_index');
    }

    #[Route('/{id}/dislike', name: 'app_post_dislike')]
    public function dislike(Post $post, LikedPostRepository $likedPostRepository): Response
    {
        if (!$likedPostRepository->findOneBy(['post'=>$post, 'user'=>$this->getUser()])) {
            return $this->redirectToRoute('app_post_index');
        }

        $likedPost = $likedPostRepository->findOneBy(['post'=>$post, 'user'=>$this->getUser()]);
        $likedPostRepository->remove($likedPost, true);
        return $this->redirectToRoute('app_post_index');
    }

    #[Route('/{id}/remove', name: 'app_post_remove')]
    public function remove(PostRepository $postRepository, Post $post): Response
    {
        $postRepository->remove($post, true);
        return $this->redirectToRoute('app_post_index');
    }
}
