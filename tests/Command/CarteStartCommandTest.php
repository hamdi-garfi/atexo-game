<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use App\Command\CarteStartCommand ;

class CarteStartCommandTest extends KernelTestCase
{
    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $application->add(new CarteStartCommand());

        $command = $application->find('carte:generate');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array(
            'command'  => $command->getName(),

            // pass arguments to the helper
            'nbrCards' =>10,
 
        ));

        // the output of the command in the console
        $output = $commandTester->getDisplay();
        $this->assertContains('nbrCards: 10', $output);
    }
}
