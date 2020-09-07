<?php

namespace filljoyner\Hound\Library;

/**
 * HoundIndexDocument
 *
 * @author   Philip Joyner  <@filljoyner>
 */
class HoundIndexDocument
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


    public function paginate($params=[])
    {
        if ($this->page_num) {
            $params['page'] = $this->page_num;
        }
        return $this->client->get('/api/documents', $params);
    }


    public function create($arguments=[], $params=[])
    {
        return $this->client->post('/api/documents', $arguments, $params);
    }


    public function show($uuid, $params=[])
    {
        return $this->client->get('/api/documents/' . $uuid, $params);
    }


    public function update($uuid, $arguments=[], $params=[])
    {
        return $this->client->put('/api/documents/' . $uuid, $arguments, $params);
    }


    public function delete($uuid, $params=[])
    {
        return $this->client->delete('/api/documents/' . $uuid, $params);
    }
}
