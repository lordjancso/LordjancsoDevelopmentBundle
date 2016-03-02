<?php

namespace Lordjancso\DevelopmentBundle\Command;

use Symfony\Component\Console\Command\Command;
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
        $phpCsFixer = $this->getApplication()->find('lordjancso:php-cs-fixer');

        if ($phpCsFixer !== 0) {
            return $phpCsFixer;
        }

        $phpUnit = $this->getApplication()->find('lordjancso:php-unit');

        if ($phpUnit !== 0) {
            return $phpUnit;
        }

        return 0;
    }
}
