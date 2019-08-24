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
        $this->setHelp('Supported websites: GitHub. Future support will include Bitbucket and GitLab');
        $this->addArgument('repo', null, InputOption::VALUE_REQUIRED);
        $this->addArgument('branch', null, InputOption::VALUE_REQUIRED);
        $this->addOption('service', null, InputOption::VALUE_OPTIONAL);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->validate($input);

        $output->write($this->getSha());
    }

    private function getSha()
    {
        $sha1 = exec('git rev-parse HEAD');

        return $sha1;
    }

    /**
     * @param InputInterface $input
     * @return bool
     * @throws \Exception
     */
    private function validateArguments(InputInterface $input)
    {
        if (!$input->getArgument('repo')) {
            throw new \Exception('The repository has not been defined');
        }

        if (!$input->getArgument('branch')) {
            throw new \Exception('The branch has not been defined');
        }

        return true;
    }

    /**
     * @param InputInterface $input
     * @return bool
     * @throws \Exception
     */
    private function validateOptions(InputInterface $input)
    {
        if ($input->getOption('service')) {
            throw new \Exception('Sorry, only GitHub is supported at this time.');
        }

        return true;
    }

    /**
     * @param InputInterface $input
     * @throws \Exception
     */
    private function validate(InputInterface $input)
    {
        $this->validateOptions($input);

        $this->validateArguments($input);
    }
}
