<?php

namespace filljoyner\Hound\Library;

use filljoyner\Hound\Library\HoundIndexDocument;

/**
 * HoundIndex
 *
 * @author   Philip Joyner  <@filljoyner>
 */
class HoundIndex
{
    private $token;
    private $client;

    /**
     * @param string $token
     */
    public function __construct($client)
    {
        $this->client = $client;
    }


    public function search()
    {
        return new HoundIndexSearch($this->client);
    }


    public function documents()
    {
        return new HoundIndexDocument($this->client);
    }
}
