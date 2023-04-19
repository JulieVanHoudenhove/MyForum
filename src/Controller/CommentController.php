<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\LikedComment;
use App\Repository\CommentRepository;
use App\Repository\LikedCommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/comment')]
class CommentController extends AbstractController
{
    #[Route('/{id}', name: 'app_comment_remove')]
    public function remove(Comment $comment, CommentRepository $commentRepository, Request $request): Response
    {
        $id = $request->query->get('post');
        $commentRepository->remove($comment, true);
        return $this->redirectToRoute('app_post_show', ['id' => $id]);
    }

    #[Route('/{id}/like', name: 'app_comment_like')]
    public function like(Comment $comment, LikedCommentRepository $likedCommentRepository): Response
    {
        $likedComment = new LikedComment();

        if ($likedCommentRepository->findOneBy(['comment'=>$comment, 'user'=>$this->getUser()])) {
            return $this->redirectToRoute('app_post_show', ['id' => $comment->getId()]);
        }

        $likedComment->setComment($comment);
        $likedComment->setUser($this->getUser());
        $likedCommentRepository->save($likedComment, true);
        return $this->redirectToRoute('app_post_show', ['id' => $comment->getId()]);
    }

    #[Route('/{id}/dislike', name: 'app_comment_dislike')]
    public function dislike(Comment $comment, LikedCommentRepository $likedCommentRepository): Response
    {
        if (!$likedCommentRepository->findOneBy(['comment'=>$comment, 'user'=>$this->getUser()])) {
            return $this->redirectToRoute('app_post_show', ['id' => $comment->getId()]);
        }

        $likedComment = $likedCommentRepository->findOneBy(['comment'=>$comment, 'user'=>$this->getUser()]);
        $likedCommentRepository->remove($likedComment, true);
        return $this->redirectToRoute('app_post_show', ['id' => $comment->getId()]);
    }

}
