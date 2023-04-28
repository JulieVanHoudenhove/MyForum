<?php

namespace App\Controller;

use App\DataTransformer\PostTransformer;
use App\Entity\Post;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use App\Service\UploaderService;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
class PostUserController extends AbstractController
{
    /**
     * @throws JWTDecodeFailureException
     */
    public function __invoke(JWTEncoderInterface $JWTEncoder, Request $request, PostRepository $postRepository, UserRepository $userRepository, PostTransformer $postTransformer): ?array
    {
        $token = $request->headers->get('Authorization');

        if ($token) {
            $token = explode(' ', $token)[1];
            $user = $JWTEncoder->decode($token);
        }

        $page = intval($request->get('page')) - 1 > 0 ? intval($request->get('page')) - 1 : 0;

        $offset = 20 * $page;

        $posts = $postRepository->findBy([], ['createdAt' => 'DESC'], 20, $offset);
        $results = [];

        foreach ($posts as $post) {
            if (isset($user)) {
                $results[] = $postTransformer->transformUser($post, $user['id']);
            } else {
                $results[] = $postTransformer->transform($post);
            }
        }

        return $results
            ;
    }
}
