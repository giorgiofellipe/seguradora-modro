<?php

namespace Faderim\Console\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Description of RunCommand
 *
 * @author ricardo
 */
class RunCommand extends \Symfony\Component\Console\Command\Command
{

    protected function configure()
    {
        $this->setName('run')
                ->setDescription('Run a Router')
                ->addArgument('router', InputArgument::REQUIRED, 'Router Name to Run')
                ->addArgument('arg', InputArgument::IS_ARRAY);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $faderimEngine = \Faderim\Core\FaderimEngine::getInstance();
        $request = new \Faderim\Console\Request();
        $args = $input->getArgument('arg');
        foreach ($args as $value) {
            list($key, $val) = explode('=', $value);
            $request->addParameter($key, $val);
        }
        $faderimEngine->setRequest($request);
        $routerName = $input->getArgument('router');
        $request->addParameter('router', $routerName);
        $front = new \Faderim\Framework\Controller\DatabaseFrontController();
        $faderimEngine->setFrontController($front);
        $faderimEngine->engineStart();
    }

}
