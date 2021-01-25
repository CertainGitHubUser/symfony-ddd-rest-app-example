<?php

namespace App\Module\User\Infrastructure\Repository;

use App\Module\User\Domain\Model\Exception\UserByNameNotFoundException;
use App\Module\User\Domain\Model\Exception\UserNotFoundException;
use App\Module\User\Domain\Model\User;
use App\Module\User\Domain\Model\UserFactoryInterface;
use App\Module\User\Domain\Model\UserId;
use App\Module\User\Domain\Model\UserName;
use App\Module\User\Domain\Model\UserRepositoryInterface;
use App\Module\User\Infrastructure\Entity\UserEntity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

final class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $manager;
    private ObjectRepository $doctrineRepository;

    private UserFactoryInterface $userFactory;

    public function __construct(EntityManagerInterface $manager, UserFactoryInterface $userFactory)
    {
        $this->manager = $manager;
        $this->doctrineRepository = $this->manager->getRepository(UserEntity::class);

        $this->userFactory = $userFactory;
    }

    public function get(UserId $userId): User
    {
        $userEntity = $this->doctrineRepository->find($userId->value());

        if (empty($userEntity)) {
            throw new UserNotFoundException($userId);
        }

        return $this->userFactory->fromDto($userEntity);
    }

    public function getByName(UserName $name): User
    {
        $userEntity = $this->doctrineRepository->findOneBy(['name' => $name->value()]);

        if (empty($userEntity)) {
            throw new UserByNameNotFoundException($name);
        }

        return $this->userFactory->fromDto($userEntity);
    }

    public function hasUser(UserName $name): bool
    {
        try {
            $this->getByName($name);
        } catch (UserByNameNotFoundException $e) {
            return false;
        }

        return true;
    }

    public function save(User $user): void
    {
        $this->manager->persist($user->getDto());
        $this->manager->flush();
    }
}