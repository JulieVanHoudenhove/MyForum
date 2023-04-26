<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserChangePasswordProcessor implements ProcessorInterface
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher, private UserRepository $userRepository, private ProcessorInterface $persistProcessor) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        if ($data instanceof User && $data->getCurrentPassword()) {
           if($this->passwordHasher->isPasswordValid($data, $data->getCurrentPassword())) {
               $newPassword = $this->passwordHasher->hashPassword($data, $data->getPlainPassword());
               $data->setPassword($newPassword)
                   ->eraseCredentials();
           }
        }

        $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}
