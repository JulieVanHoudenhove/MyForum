<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/post')]
class PostController extends AbstractController
{
    #[Route('/', name: 'app_post_index')]
    public function index(PostRepository $postRepository): Response
    {
        return $this->render('post/index.html.twig', 
        [
            'controller_name' => 'PostController',
            'posts' => $postRepository->findAll()
        ]);
    }

    #[Route('/{id}', name: 'app_post_show')]
    public function show(Post $post, Request $request): Response
    {
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        return $this->render('post/show.html.twig', 
        [
            'controller_name' => 'PostController',
            'post' => $post,
            'form' => $form,
            'comment' => $comment
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

        return $this->renderForm('post/new.html.twig', 
        [
            'controller_name' => 'PostController',
            'post' => $post,
            'form' => $form
        ]);
    }

    #[Route('/{id}/remove', name: 'app_post_remove')]
    public function remove(PostRepository $postRepository, Post $post): Response
    {
        $postRepository->remove($post, true);
        return $this->redirectToRoute('app_post_index');
    }
}
