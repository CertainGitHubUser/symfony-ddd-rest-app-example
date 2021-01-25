<?php

namespace App\Module\User\Tests\Domain\Model\User;

use App\Module\User\Domain\Model\Exception\InvalidUserIdException;
use App\Module\User\Domain\Model\UserId;
use PHPUnit\Framework\TestCase;

final class UserIdTest extends TestCase
{
    /**
     * @dataProvider provide_validUserId
     */
    public function test_should_be_valid_user_id(int $userId): void
    {
        // when
        $valueObject = new UserId($userId);

        // then
        $this->assertEquals($userId, $valueObject->value());
    }

    public function provide_validUserId(): array
    {
        return [
            [1],
            [45453],
        ];
    }

    /**
     * @dataProvider provide_invalidUserId
     */
    public function test_should_be_invalid_user_id(int $userId): void
    {
        // when / then
        $this->expectExceptionObject(new InvalidUserIdException($userId));
        $valueObject = new UserId($userId);
    }

    public function provide_invalidUserId(): array
    {
        return [
            [0],
            [-1],
        ];
    }
}