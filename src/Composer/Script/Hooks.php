<?php

namespace Lordjancso\DevelopmentBundle\Composer\Script;

use Composer\Script\Event;

class Hooks
{
    public static function checkHooks(Event $event)
    {
        $io = $event->getIO();
        $gitHook = @file_get_contents(__DIR__.'/../../../../../../.git/hooks/pre-commit');
        $docHook = @file_get_contents(__DIR__.'/../../../docs/hooks/pre-commit');

        if ($gitHook !== $docHook) {
            $io->write('<error>Please set up your fucking hooks!</error>');
            $io->write('<error>rm -rf .git/hooks && ln -s ../vendor/lordjancso/development-bundle/docs/hooks .git/hooks</error>');

            return false;
        }

        return true;
    }
}
