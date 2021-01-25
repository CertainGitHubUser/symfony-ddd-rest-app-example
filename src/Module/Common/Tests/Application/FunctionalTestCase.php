<?php

namespace App\Module\Common\Tests\Application;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;

abstract class FunctionalTestCase extends KernelTestCase
{
    protected KernelInterface $_kernel;
    protected EntityManagerInterface $_em;

    protected function setUp(): void
    {
        $this->_kernel = self::bootKernel();

        $GLOBALS['kernel'] = $this->_kernel;

        $this->_em = $this->_kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    //TODO delete request stack
    protected function updateRequestStack(): void
    {
        $request = Request::createFromGlobals();
        $requestStack = self::$kernel->getContainer()->get('request_stack');
        $requestStack->push($request);
    }
}