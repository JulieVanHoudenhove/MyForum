<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploaderService
{
    public const AVATAR = 1;
    public const POST = 2;
    private SluggerInterface $slugger;

    public function __construct(private $avatarDirectory, private $postDirectory, SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    public function uploadImage($file, $type): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        if ($type == self::AVATAR) {
            try {
                $file->move(
                    $this->getAvatarDirectory(),
                    $newFilename
                );
            } catch (FileException $e) {
                // if something happens during upload
            }
        } elseif ($type == self::POST) {
            try {
                $file->move(
                    $this->getPostDirectory(),
                    $newFilename
                );
            } catch (FileException $e) {
                // if something happens during upload
            }
        }
        return $newFilename;
    }

    public function getAvatarDirectory()
    {
        return $this->avatarDirectory['avatarDirectory'];
    }

    public function getPostDirectory()
    {
        return $this->postDirectory['postDirectory'];
    }

}