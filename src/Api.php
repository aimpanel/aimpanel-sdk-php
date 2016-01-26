<?php

namespace Aimpanel\SDK;

class Api
{

    public $client;
    //services
    public $minecraft, $ts3;

    public function __construct($config)
    {
        $this->client = new ApiClient($config);
        $this->minecraft = new API\Minecraft($this->client);
        $this->ts3 = new API\TeamSpeak3($this->client);
    }

}
