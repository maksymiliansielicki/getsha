#!/usr/bin/env php

<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

$getShaCommand = new \App\Commands\GetShaCommand();

$script = new Application();
$script->add($getShaCommand);
/**
 * Unfortunately, we cannot set GetShaCommand as default, because according to the Symfony docs, arguments would be then ignored.
 * So instead, we seem to have to add 'getsha' as a first argument.
 * @see https://symfony.com/doc/current/components/console/changing_default_command.html
 */
//$script->setDefaultCommand($getShaCommand->getName());
$script->run();
