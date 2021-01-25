<?php

namespace App\Module\User\Application\UseCase\GetUser;

use App\Module\User\Domain\Model\User;
use App\Module\User\Domain\Model\UserRepositoryInterface;

final class GetUser
{
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function handle(GetUserRequest $request): User
    {
        return $this->userRepository->get($request->getUserId());
    }
}