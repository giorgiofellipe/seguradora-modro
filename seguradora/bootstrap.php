<?php

use Faderim\Core\FaderimEngine;

$autoLoader = require_once dirname(__FILE__) . '/vendor/autoload.php';
$faderimEngine = FaderimEngine::getInstance();
$faderimEngine->setRequest(new \Faderim\Core\HttpRequest());
$faderimEngine->setLoader($autoLoader);
$app = $faderimEngine->getAppConfig();
$faderimEngine->setFrontController(new $app['faderim']['front-controller']);
$faderimEngine->engineStart();
