<?php

namespace App\Service;


use App\DataTransformer\CommentDtoTransformer;
use App\DataTransformer\PostDtoTransformer;
use App\Repository\CommentRepository;
use App\Repository\PostRepository;

class PostService
{
    private PostRepository $postRepository;
    private PostDtoTransformer $postDtoTransformer;
    private CommentDtoTransformer $commentDtoTransformer;
    private CommentRepository $commentRepository;

    public function __construct(PostRepository $postRepository, PostDtoTransformer $postDtoTransformer, CommentDtoTransformer $commentDtoTransformer, CommentRepository $commentRepository)
    {
        $this->postRepository = $postRepository;
        $this->postDtoTransformer = $postDtoTransformer;
        $this->commentDtoTransformer = $commentDtoTransformer;
        $this->commentRepository = $commentRepository;
    }

    public function getPostsByDate($limit, $currentUser): array
    {
        $posts = $this->postRepository->findOrderDate($limit);
        if ($currentUser !== null) {
            $results = $this->postDtoTransformer->transformPosts($posts, $currentUser);
            return $results;
        }

        return $posts;
    }

    public function RenderSinglePost($post, $currentUser): array
    {
        $comments = $this->commentRepository->findBy(['post' => $post]);

        if ($currentUser) {
            $result_post = $this->postDtoTransformer->transformPost($post, $currentUser);
            $result_comments = $this->commentDtoTransformer->transform($comments, $currentUser);
            return [$result_post, $result_comments];
        }

        return [$post, $comments];
    }
}