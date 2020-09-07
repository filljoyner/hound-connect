<?php

namespace filljoyner\Hound\Library;

use GuzzleHttp\Psr7\Response;

/**
 * HoundResponse
 *
 * @author   Philip Joyner  <@filljoyner>
 */
class HoundResponse
{
    private $response;

    /**
     * @param string $token
     */
    public function __construct(Response $response)
    {
        $this->response = $response;
    }


    public function successful()
    {
        $code = $this->code();
        if ($code >= 200 and $code < 300) {
            return true;
        }
        return false;
    }


    public function code()
    {
        return $this->response->getStatusCode();
    }


    public function json()
    {
        return json_decode($this->response->getBody(), true);
    }


    public function body()
    {
        return $this->response->getBody();
    }


    public function dump()
    {
        var_dump($this->json());
    }
}
