<?php

namespace App\Module\Product;

use App\Module\Product\Infrastructure\DependencyInjection\SdraeProductExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class SdraeProductBundle extends Bundle
{
    public function getContainerExtension()
    {
        return new SdraeProductExtension();
    }
}