<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CarteStartCommandTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

       // $this->assertSame('test', $kernel->getEnvironment());
        //$routerService = self::$container->get('router');
        //$myCustomService = self::$container->get(CustomService::class);
    }
}
