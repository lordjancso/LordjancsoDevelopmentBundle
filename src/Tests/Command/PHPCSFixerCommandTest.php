<?php

namespace Lordjancso\DevelopmentBundle\Tests\Command;

use Lordjancso\DevelopmentBundle\Command\PHPCSFixerCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class PHPCSFixerCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new PHPCSFixerCommand());

        $command = $application->find('lordjancso:php-cs-fixer');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertEquals(0, $commandTester->getStatusCode());
    }
}
