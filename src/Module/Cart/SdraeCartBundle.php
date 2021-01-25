<?php

namespace App\Module\Cart;

use App\Module\Cart\Infrastructure\DependencyInjection\SdraeCartExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SdraeCartBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new SdraeCartExtension();
    }
}