<?php

namespace Lordjancso\DevelopmentBundle\Tests\Command;

use Lordjancso\DevelopmentBundle\Command\CodeQACommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class CodeQACommandTest extends \PHPUnit_Framework_TestCase
{
    public function testExecute()
    {
        $application = new Application();
        $application->add(new CodeQACommand());

        $command = $application->find('lordjancso:code-qa');
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        $this->assertContains('PHP CS FIXER', $commandTester->getDisplay());
    }
}
