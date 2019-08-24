<?php

namespace App\Builders;

use Symfony\Component\Console\Input\InputInterface;

class UriBuilder
{
    /**
     * @var InputInterface
     */
    private $input;

    /**
     * UriBuilder constructor.
     * @param InputInterface $input
     */
    public function __construct(InputInterface $input)
    {
        $this->input = $input;
    }

    /**
     * Build a URL for web hosting service. Defaults to GitHub
     *
     * @return string
     * @throws \Exception
     */
    public function build()
    {
        // TODO: When the support for other services is introduced, the condition below can be deleted.
        if ($this->input->getOption('service')) {
            throw new \Exception('Unfortunately, only GitHub is supported at this time');
        }

        switch($this->input->getOption('service')) {
            default:
                return $this->buildForGithub();
        }
    }

    /**
     * @see https://developer.github.com/v3/repos/branches/#get-branch
     * @return string
     */
    private function buildForGithub()
    {
        return 'https://api.github.com/repos/' . $this->input->getArgument('repo') . '/branches/' . $this->input->getArgument('branch');
    }
}
