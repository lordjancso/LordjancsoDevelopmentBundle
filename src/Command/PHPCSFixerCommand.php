<?php

namespace Lordjancso\DevelopmentBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class PHPCSFixerCommand extends Command
{
    protected function configure()
    {
        $this->setName('lordjancso:php-cs-fixer')
            ->setDescription('PHP CS Fixer');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('PHP CS FIXER');

        $command = new Process('php vendor/fabpot/php-cs-fixer/php-cs-fixer --dry-run --diff --verbose --config=sf23 --level=symfony fix ./');
        $command->run(function ($type, $buffer) {
            echo $buffer;
        });

        if (strpos($command->getOutput(), '---------- begin diff ----------') !== false) {
            return 1;
        }

        return 0;
    }
}
