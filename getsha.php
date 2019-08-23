#!/usr/bin/env php

<?php

require_once __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;

$script = new Application();
$script->add(new Commands\GetShaCommand());
$script->run();
