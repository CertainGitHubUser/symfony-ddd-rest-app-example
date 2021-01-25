<?php

namespace App\Module\User\Tests\Application\UseCase;

use App\Module\Common\Tests\Application\FunctionalTestCase;
use App\Module\User\Domain\Model\UserFactoryInterface;
use App\Module\User\Domain\Model\UserRepositoryInterface;
use App\Module\User\Infrastructure\Factory\UserFactory;
use App\Module\User\Infrastructure\Repository\DoctrineUserRepository;
use Doctrine\ORM\EntityManagerInterface;

class UserFunctionalTestCase extends FunctionalTestCase
{
    public UserFactoryInterface $userFactory;

    public UserRepositoryInterface $userRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userFactory = new UserFactory();
        $this->userRepository = new DoctrineUserRepository($this->_em, $this->userFactory);
    }
}