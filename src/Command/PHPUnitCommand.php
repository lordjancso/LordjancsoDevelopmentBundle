<?php

namespace Lordjancso\DevelopmentBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class PHPUnitCommand extends Command
{
    protected function configure()
    {
        $this->setName('lordjancso:php-unit')
            ->setDescription('PHP Unit');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('PHP Unit');

        $command = new Process('php vendor/phpunit/phpunit/phpunit');
        $command->setTimeout(null);
        $command->run(function ($type, $buffer) {
            echo $buffer;
        });

        if (strpos($command->getOutput(), 'FAILURES!') !== false) {
            return 1;
        }

        return 0;
    }
}
