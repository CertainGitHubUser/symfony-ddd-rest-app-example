<?php

namespace App\Module\User\Application\Facade;

use App\Module\User\Application\UseCase\AddUser\AddUserRequest;
use App\Module\User\Application\UseCase\GetUser\GetUserRequest;
use App\Module\User\Domain\Model\User;
use Symfony\Component\HttpKernel\KernelInterface;

final class UserFacade
{
    private KernelInterface $kernel;

    public function __construct(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public static function instance(): self
    {
        global $kernel;

        return new self($kernel);
    }

    public function addUser(string $name): User
    {
        $request = new AddUserRequest($name);
        $service = $this->kernel->getContainer()->get('sdrae.user.use_case.add_user');

        return $service->handle($request);
    }

    public function getUser(int $userId): User
    {
        $request = new GetUserRequest($userId);
        $service = $this->kernel->getContainer()->get('sdrae.user.use_case.get_user');

        return $service->handle($request);
    }
}