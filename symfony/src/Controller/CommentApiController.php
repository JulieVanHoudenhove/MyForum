<?php

namespace App\Controller;

use App\DataTransformer\CommentTransformer;
use App\DataTransformer\PostTransformer;
use App\Entity\Post;
use App\Repository\CommentRepository;
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
class CommentApiController extends AbstractController
{
    /**
     * @throws JWTDecodeFailureException
     */
    public function __invoke(JWTEncoderInterface $JWTEncoder, Request $request, CommentRepository $commentRepository, UserRepository $userRepository, CommentTransformer $commentTransformer): ?array
    {
        $token = $request->headers->get('Authorization');

        if ($token) {
            $token = explode(' ', $token)[1];
            $user = $JWTEncoder->decode($token);
        }

        $page = 1;

        $offset = 20 * $page;

        $comments = $commentRepository->findBy([], ['createdAt' => 'DESC'], 20, $offset);
        $results = [];

        foreach ($comments as $comment) {
            if (isset($user)) {
                $results[] = $commentTransformer->transformUser($comment, $user['id']);
            } else {
                $results[] = $commentTransformer->transform($comment);
            }
        }

        return $results
            ;
    }
}
