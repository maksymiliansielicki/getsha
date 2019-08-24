<?php

namespace App\Services;

use App\Builders\UriBuilder;
use GuzzleHttp\Client;

class GetShaService
{
    /**
     * @var UriBuilder
     */
    private $uriBuilder;

    /**
     * @var Client
     */
    private $http;

    /**
     * GetShaService constructor.
     * @param UriBuilder $builder
     * @param Client $http
     */
    public function __construct(UriBuilder $uriBuilder, Client $http)
    {
        $this->uriBuilder = $uriBuilder;
        $this->http = $http;
    }

    /**
     * Makes a request to a web-hosting service using Guzzle.
     *
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getSha()
    {
        /** @var string $uri */
        $uri = $this->uriBuilder->build();

        try {
            /** @var \GuzzleHttp\Psr7\Response $response */
            $response = $this->http->request('GET', $uri);

            /** @var \stdClass $contents */
            $contents = \GuzzleHttp\json_decode($response->getBody()->getContents());

            return $contents->commit->sha;
        } catch(\Exception $exception) {
            throw new \Exception('Either an error has occurred, the repository is private or the branch does not exist');
        }
    }
}
