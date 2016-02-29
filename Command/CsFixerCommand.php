<?php

namespace Lordjancso\DevelopmentBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class CsFixerCommand extends Command
{
    protected function configure()
    {
        $this->setName('lordjancso:cs-fixer')
            ->setDescription('Fix Symfony coding standards');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $process = new Process('php vendor/fabpot/php-cs-fixer/php-cs-fixer --dry-run --diff --verbose --config=sf23 --level=symfony fix ./');
        $process->run(function ($type, $buffer) {
            echo $buffer;
        });
    }
}
