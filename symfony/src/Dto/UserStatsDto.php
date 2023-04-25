<?php

namespace App\Dto;

use App\Entity\User;
use Symfony\Component\Serializer\Annotation\Groups;

class UserStatsDto
{
    #[Groups(['user:stats'])]
    public int $id;

    #[Groups(['user:stats'])]
    public int $lastWeekLike;

    #[Groups(['user:stats'])]
    public int $lastWeekPost;

    #[Groups(['user:stats'])]
    public int $totalPost;

    #[Groups(['user:stats'])]
    public int $totalLike;

    #[Groups(['user:stats'])]
    public array $mostActiveUsers = [];

    #[Groups(['user:stats'])]
    public array $likesPerWeek = [];

    public function __construct(int $id, int $lastWeekLike, int $lastWeekPost, int $totalPost, int $totalLike, array $mostActiveUsers, array $likesPerWeek)
    {
        $this->id = $id;
        $this->lastWeekLike = $lastWeekLike;
        $this->lastWeekPost = $lastWeekPost;
        $this->totalPost = $totalPost;
        $this->totalLike = $totalLike;
        $this->mostActiveUsers = $mostActiveUsers;
        $this->likesPerWeek = $likesPerWeek;
    }


}