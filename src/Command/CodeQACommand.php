<?php

namespace Lordjancso\DevelopmentBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CodeQACommand extends Command
{
    protected function configure()
    {
        $this->setName('lordjancso:code-qa')
            ->setDescription('Code quality assurance');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $phpCsFixerCommand = $this->getApplication()->find('lordjancso:php-cs-fixer');
        $phpCsFixerArguments = array();
        $phpCsFixerInput = new ArrayInput($phpCsFixerArguments);
        $phpCsFixer = $phpCsFixerCommand->run($phpCsFixerInput, $output);

        if ($phpCsFixer !== 0) {
            return $phpCsFixer;
        }

        $phpUnitCommand = $this->getApplication()->find('lordjancso:php-unit');
        $phpUnitArguments = array();
        $phpUnitInput = new ArrayInput($phpUnitArguments);
        $phpUnit = $phpUnitCommand->run($phpUnitInput, $output);

        if ($phpUnit !== 0) {
            return $phpUnit;
        }

        return 0;
    }
}
