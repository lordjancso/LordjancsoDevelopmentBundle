<?php

namespace Lordjancso\DevelopmentBundle\Tests\Command;

use Lordjancso\DevelopmentBundle\Command\CsFixerCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CsFixerCommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new CsFixerCommand());

        $command = $application->find('lordjancso:cs-fixer');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertEquals('', $commandTester->getDisplay());
    }
}
