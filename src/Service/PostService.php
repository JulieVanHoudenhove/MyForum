<?php

namespace App\Service;


use App\Dto\PostDtoTransformer;
use App\Repository\PostRepository;

class PostService
{
    private PostRepository $postRepository;
    private PostDtoTransformer $postDtoTransformer;

    public function __construct(PostRepository $postRepository, PostDtoTransformer $postDtoTransformer)
    {
        $this->postRepository = $postRepository;
        $this->postDtoTransformer = $postDtoTransformer;
    }

    public function getPostsByDate($limit, $currentUser)
    {
        $posts = $this->postRepository->findOrderDate($limit);
        if ($currentUser !== null) {
            $results = $this->postDtoTransformer->transformFromObjects($posts, $currentUser);
            return $results;
        }

        return $posts;
    }

//    public function RenderSinglePost($currentUser)
//    {
//        if ($currentUser) {
//            $result = $postDtoTransformer->transformFromObject($post, $this->getUser());
//        } else {
//            $result = $post;
//        }
//
//        $comments = $commentRepository->findBy(['post' => $post]);
//
//        if ($currentUser) {
//            $result_comments = $commentDtoTransformer->transform($comments, $this->getUser());
//        } else {
//            $result_comments = $comments;
//        }
//    }
}