<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\UrlHelper;
use Symfony\Component\String\Slugger\SluggerInterface;

class UploaderService
{
    public const AVATAR = 1;
    public const POST = 2;
    private SluggerInterface $slugger;

    public function __construct(private $avatarDirectory, private $postDirectory, private $publicAvatarPath, private $publicPostPath, SluggerInterface $slugger, private UrlHelper $urlHelper)
    {
        $this->slugger = $slugger;
    }
    public function uploadImage($file, string $type): string
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        switch ($type) {
            case self::AVATAR:
                $path = $this->getAvatarDirectory();
                break;
            case self::POST:
                $path = $this->getPostDirectory();
                break;
        }

        try {
            $file->move(
                $path,
                $newFilename
            );
        } catch (FileException $e) {
            // if something happens during upload
        }

        return $newFilename;
    }

    public function getUrl(?string $fileName, string $type, bool $absolute = true): ?string
    {
        switch ($type) {
            case self::AVATAR:
                $path = $this->getPublicAvatarPath();
                break;
            case self::POST:
                $path = $this->getPublicPostPath();
                break;
        }
        if (empty($fileName)) return null;

        if ($absolute) {
            return $this->urlHelper->getAbsoluteUrl($path . '/' . $fileName);
        }

        return $this->urlHelper->getRelativePath($path . '/' . $fileName);
    }

    public function getAvatarDirectory()
    {
        return $this->avatarDirectory['avatarDirectory'];
    }

    public function getPostDirectory()
    {
        return $this->postDirectory['postDirectory'];
    }

    public function getPublicAvatarPath()
    {
        return $this->publicAvatarPath['publicAvatarPath'];
    }

    public function getPublicPostPath()
    {
        return $this->publicPostPath['publicPostPath'];
    }

}