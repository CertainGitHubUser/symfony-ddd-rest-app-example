<?php

namespace App\Module\User\Infrastructure\Entity;

use App\Module\User\Domain\Model\UserDtoInterface;
use App\Module\User\Domain\Model\UserId;
use App\Module\User\Domain\Model\UserName;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table("user")
 */
class UserEntity implements UserDtoInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer", options={"unsigned": true})
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private string $name;

    public function getId(): UserId
    {
        return UserId::fromString($this->id);
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = UserId::fromString($id)->value();
    }

    public function getName(): UserName
    {
        return UserName::fromString($this->name);
    }

    public function setName(string $name): void
    {
        $this->name = UserName::fromString($name)->value();
    }
}