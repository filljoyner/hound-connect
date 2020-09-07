<?php

namespace filljoyner\Hound\Library;

/**
 * HoundIndexSearch
 *
 * @author   Philip Joyner  <@filljoyner>
 */
class HoundIndexSearch
{
    private $client;

    /**
     * @param string $token
     */
    public function __construct($client)
    {
        $this->client = $client;
    }


    public function for($query_string='', $params=[])
    {
        $params['q'] = $query_string;
        return $this->client->get('/api/search', $params);
    }
}
