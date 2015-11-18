<?php

$autoLoader = require_once dirname(__FILE__) . '/vendor/autoload.php';
$faderimEngine = \Faderim\Core\FaderimEngine::getInstance();
$faderimEngine->setLoader($autoLoader);

$t = new \Symfony\Component\Console\Application();
$t->add(new Faderim\Console\Command\RunCommand());
$t->run();
