<?php

namespace Lordjancso\DevelopmentBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class CodeQACommand extends Command
{
    protected function configure()
    {
        $this->setName('lordjancso:code-qa')
            ->setDescription('Code quality assurance');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('PHP CS FIXER');

        $phpCsFixer = new Process('php vendor/fabpot/php-cs-fixer/php-cs-fixer --dry-run --diff --verbose --config=sf23 --level=symfony fix ./');
        $phpCsFixer->run(function ($type, $buffer) {
            echo $buffer;
        });

        if (strpos($phpCsFixer->getOutput(), '---------- begin diff ----------') !== false) {
            return 1;
        }

        $output->writeln('PHP UNIT');

        $phpUnit = new Process('php vendor/phpunit/phpunit/phpunit');
        $phpUnit->run(function ($type, $buffer) {
            echo $buffer;
        });

        return 0;
    }
}
