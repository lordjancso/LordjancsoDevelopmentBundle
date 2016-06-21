<?php

namespace Lordjancso\DevelopmentBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class PHPCSFixerCommand extends Command
{
    protected function configure()
    {
        $this->setName('lordjancso:php-cs-fixer')
            ->setDescription('PHP CS Fixer')
            ->addOption('disable-dry-run', null, InputOption::VALUE_NONE, 'Disable dry run');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('PHP CS FIXER');

        $cmd = 'php vendor/fabpot/php-cs-fixer/php-cs-fixer';
        if (!$input->getOption('disable-dry-run')) {
            $cmd .= ' --dry-run';
        }
        $cmd .= ' --diff --verbose --config=sf23 --level=symfony --fixers=long_array_syntax,ordered_use fix ./';

        $command = new Process($cmd);
        $command->setTimeout(null);
        $command->run(function ($type, $buffer) {
            echo $buffer;
        });

        if (strpos($command->getOutput(), '---------- begin diff ----------') !== false) {
            return 1;
        }

        return 0;
    }
}
