<?php

require_once 'vendor/autoload.php';
$faderimEngine = \Faderim\Core\FaderimEngine::getInstance();
$faderimEngine->engineStart(null);
$helperSet = new \Symfony\Component\Console\Helper\HelperSet(array(
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($faderimEngine->getEntityManager())
        ));
return $helperSet;
