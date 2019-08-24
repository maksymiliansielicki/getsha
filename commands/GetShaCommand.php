<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GetShaCommand extends Command
{
    protected static $defaultName = 'getsha';

    protected function configure()
    {
        $this->setName('getsha');
        $this->setDescription('Prints the SHA1 of the last commit to the screen');
        $this->addArgument('repo', null, InputOption::VALUE_REQUIRED);
        $this->addArgument('branch', null, InputOption::VALUE_REQUIRED);
        $this->addOption('service', null, InputOption::VALUE_OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write($this->getSha());
    }

    private function getSha()
    {
        $sha1 = exec('git rev-parse HEAD');

        return $sha1;
    }
}
