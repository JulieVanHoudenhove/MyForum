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

    public function __construct(private $avatarDirectory, private $postDirectory, SluggerInterface $slugger, private UrlHelper $urlHelper)
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
                try {
                    $file->move(
                        $this->getAvatarDirectory(),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // if something happens during upload
                }
                break;
            case self::POST:
                try {
                    $file->move(
                        $this->getPostDirectory(),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // if something happens during upload
                }
                break;
        }
        return $newFilename;
    }

    public function getUrl(?string $fileName, string $type, bool $absolute = true): ?string
    {
        switch ($type) {
            case self::AVATAR:
                $path = $this->getAvatarDirectory();
                break;
            case self::POST:
                $path = $this->getPostDirectory();
                break;
        }
        if (empty($fileName)) return null;

        if ($absolute) {
            return $this->urlHelper->getAbsoluteUrl($path.$fileName);
        }

        return $this->urlHelper->getRelativePath($path.$fileName);
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