<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AvatarType;
use App\Repository\UserRepository;
use App\Service\UploaderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

#[AsController]
class UploadImageController extends AbstractController
{
    public function __invoke(Request $request, UserRepository $userRepository, UploaderService $uploaderService): ?User
    {
        $avatarFile = $request->files->get('file');

        if (!$avatarFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $userId = $request->get('id');

        if (!$userId) {
            throw new BadRequestHttpException('"userId" is required');
        }

        $user = $userRepository->findOneBy(['id' => $userId]);

        if ($avatarFile) {
            if($user->getAvatar() != null) {
                $filesystem = new Filesystem();
                $oldFile = $user->getAvatar();
                $path = $this->getParameter('avatars_directory').'/'.$oldFile;
                $filesystem->remove($path);
            }

            $filename = $uploaderService->uploadImage($avatarFile, UploaderService::AVATAR);
            $user->setAvatar($filename);
        }

            return $user;
        }
}
