<?php

namespace App\Module\User\Tests\Application\UseCase\AddUser;

use App\Module\User\Application\UseCase\AddUser\AddUserRequest;
use App\Module\User\Domain\Model\Exception\UserAlreadyExistException;
use App\Module\User\Domain\Model\User;
use App\Module\User\Domain\Model\UserName;
use App\Module\User\Tests\Application\UseCase\UserFunctionalTestCase;

final class AddUserTest extends UserFunctionalTestCase
{
    public function test_should_add_user(): void
    {
        // given
        $name = bin2hex(random_bytes(12));

        // when
        $this->runAddUserUseCase($name);

        // then
        $createdUserName = $this->userRepository->getByName(new UserName($name))->title()->value();
        $this->assertEquals($createdUserName, $name);
    }

    public function test_should_throw_exception_when_trying_to_create_user_with_same_name(): void
    {
        // given
        $name = bin2hex(random_bytes(12));
        $this->runAddUserUseCase($name);

        // then
        $this->expectExceptionObject(new UserAlreadyExistException($name));

        // when
        $this->runAddUserUseCase($name);
    }

    private function runAddUserUseCase(string $name): User
    {
        return self::$kernel->getContainer()->get('sdrae.user.use_case.add_user')->handle(new AddUserRequest($name));
    }
}