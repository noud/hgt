<?php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

// ... register commands

$application->run();

$application->add($application->add(new \AppBundle\Command\CreateUserCommand()));
