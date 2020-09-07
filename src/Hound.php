<?php

namespace filljoyner\Hound;

use filljoyner\Hound\Library\HoundIndex;
use filljoyner\Hound\Library\HoundClient;

/**
 * Hound
 *
 * @author   Philip Joyner  <@filljoyner>
 */
class Hound
{
    private $client;
    private $config = [
        'base_uri' => 'https://hound.pgondevops.com'
    ];


    public function __construct($config=[], $client=null)
    {
        if (!$client) {
            $client = new \GuzzleHttp\Client($this->buildConfig($config));
        }

        $this->client = new HoundClient($client);
    }


    public function index($index, $token=null)
    {
        $this->client->setIndex($index);
        $this->client->setToken($token);
        return new HoundIndex($this->client);
    }


    private function buildConfig($config)
    {
        return array_merge($this->config, $config);
    }
}
