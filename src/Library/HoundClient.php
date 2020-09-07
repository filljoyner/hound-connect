<?php

namespace filljoyner\Hound\Library;

use GuzzleHttp\Client;
use filljoyner\Hound\Library\HoundResponse;

/**
 * HoundClient
 *
 * @author   Philip Joyner  <@filljoyner>
 */
class HoundClient
{
    private $client;
    private $index;
    private $token;

    /**
     * @param string $token
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }


    public function setIndex($index)
    {
        $this->index = $index;
    }


    public function setToken($token)
    {
        $this->token = $token;
    }


    public function get($uri, $params=[])
    {
        return new HoundResponse(
            $this->client->request('GET', $uri, $this->buildParameters($params))
        );
    }


    public function post($uri, $arguments=[], $params=[])
    {
        return new HoundResponse(
            $this->client->request('POST', $uri, $this->buildParameters($params, $arguments))
        );
    }


    public function put($uri, $arguments=[], $params=[])
    {
        return new HoundResponse(
            $this->client->request('PUT', $uri, $this->buildParameters($params, $arguments))
        );
    }


    public function delete($uri, $params=[])
    {
        return new HoundResponse(
            $this->client->request('DELETE', $uri, $this->buildParameters($params))
        );
    }


    private function buildParameters($params=[], $arguments=[])
    {
        $payload = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
            'query' => $this->buildQueryParameters($params)
        ];

        if ($arguments) {
            $payload['json'] = $arguments;
        }

        return $payload;
    }


    private function buildQueryParameters($params=[])
    {
        $params['index'] = $this->index;

        if ($this->token) {
            $params['token'] = $this->token;
        }

        return $params;
    }
}
