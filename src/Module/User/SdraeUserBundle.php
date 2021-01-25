<?php

namespace App\Module\User;

use App\Module\User\Infrastructure\DependencyInjection\SdraeUserExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SdraeUserBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new SdraeUserExtension();
    }
}