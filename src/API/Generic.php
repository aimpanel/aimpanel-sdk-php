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

    function turn_on($id)
    {
        return $this->client->http_json("GET", "services/" . $this->service . "/" . $id . "/start", []);
    }

    function turn_off($id)
    {
        return $this->client->http_json("GET", "services/" . $this->service . "/" . $id . "/stop", []);
    }

}
