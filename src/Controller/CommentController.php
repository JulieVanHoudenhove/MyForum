<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    #[Route('/comment/{id}', name: 'app_comment_remove')]
    public function remove(Comment $comment, CommentRepository $commentRepository, Request $request): Response
    {
        $id = $request->query->get('post');
        $commentRepository->remove($comment, true);
        return $this->redirectToRoute('app_post_show', ['id' => $id]);
    }
}
