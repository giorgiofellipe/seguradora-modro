<?php

$autoLoader = require_once dirname(__FILE__) . '/../vendor/autoload.php';
$faderimEngine = \Faderim\Core\FaderimEngine::getInstance();
$faderimEngine->setRequest(new \Faderim\Core\HttpRequest());
$faderimEngine->setLoader($autoLoader);
$faderimEngine->setFrontController(new \Faderim\Framework\Controller\DatabaseFrontController());
$faderimEngine->engineStart();
