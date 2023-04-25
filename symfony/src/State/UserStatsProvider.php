<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\DataTransformer\PostTransformer;
use App\Dto\UserStatsDto;
use App\Repository\LikedPostRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;

class UserStatsProvider implements ProviderInterface
{
    public function __construct(private ProviderInterface $itemProvider, private LikedPostRepository $likedPostRepository, private UserRepository $userRepository, private PostRepository $postRepository)
    {
    }
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {

        $user = $this->itemProvider->provide($operation, $uriVariables, $context);

        $lastWeekLike = count($this->likedPostRepository->countLastWeekLike($user));
        $lastWeekPost = count($this->postRepository->countLastWeekPost($user));
        $totalPost = count($this->postRepository->countTotalPost($user));
        $totalLike = count($this->likedPostRepository->countTotalLike($user));
        $mostActiveUsers = $this->userRepository->findMostActiveUser();
        $likesPerWeek = $this->likedPostRepository->countLikeSortByWeek();


        return new UserStatsDto(
            $user->getId(),
            $lastWeekLike,
            $lastWeekPost,
            $totalPost,
            $totalLike,
            $mostActiveUsers,
            $likesPerWeek
        );
    }
}
