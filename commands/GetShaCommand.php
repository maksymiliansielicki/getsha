<?php

namespace Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetShaCommand extends Command
{
    protected function configure()
    {
        $this->setName('getsha');
        $this->setDescription('Prints the SHA1 of the last commit to the screen');
        $this->addArgument('service');
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
