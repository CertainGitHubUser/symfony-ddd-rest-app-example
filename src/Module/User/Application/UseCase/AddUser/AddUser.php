<?php

namespace App\Module\User\Application\UseCase\AddUser;

use App\Module\User\Domain\Model\Exception\UserAlreadyExistException;
use App\Module\User\Domain\Model\User;
use App\Module\User\Domain\Model\UserFactoryInterface;
use App\Module\User\Domain\Model\UserRepositoryInterface;

final class AddUser
{
    private UserFactoryInterface $userFactory;

    private UserRepositoryInterface $userRepository;

    public function __construct(UserFactoryInterface $userFactory, UserRepositoryInterface $userRepository)
    {
        $this->userFactory = $userFactory;
        $this->userRepository = $userRepository;
    }

    public function handle(AddUserRequest $request): User
    {
        $this->assertIsValid($request);

        $user = $this->userFactory->fromArgs($request->getName());
        $this->userRepository->save($user);

        return $this->userRepository->getByName($user->title());
    }

    public function assertIsValid(AddUserRequest $request): void
    {
        if ($this->userRepository->hasUser($request->getName())) {
            throw new UserAlreadyExistException($request->getName());
        }
    }
}