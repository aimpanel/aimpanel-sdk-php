<?php

namespace Aimpanel\SDK\API;

trait Generic
{

    /**
     * @var Aimpanel\SDK\ApiClient
     */
    private $client;

    function __construct($client)
    {
        $this->client = $client;
    }

    function list_all()
    {
        return $this->client->http_json("GET", "services/" . $this->service, []);
    }

    function info($id)
    {
        return $this->client->http_json("GET", "services/" . $this->service . "/" . $id . "/info", []);
    }

    function turn_on($id)
    {
        return $this->client->http_json("GET", "services/" . $this->service . "/" . $id . "/start", []);
    }

    function restart($id)
    {
        return $this->client->http_json("GET", "services/" . $this->service . "/" . $id . "/restart", []);
    }

    function turn_off($id)
    {
        return $this->client->http_json("GET", "services/" . $this->service . "/" . $id . "/stop", []);
    }

}
