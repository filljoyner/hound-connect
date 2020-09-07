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
    private $page_num;

    /**
     * @param string $token
     */
    public function __construct($client)
    {
        $this->client = $client;
    }


    public function page($page_num)
    {
        $this->page_num = $page_num;
        return $this;
    }


    public function for($query_string='', $params=[])
    {
        $params['q'] = $query_string;
        if ($this->page_num) {
            $params['page'] = $this->page_num;
        }
        return $this->client->get('/api/search', $params);
    }
}
