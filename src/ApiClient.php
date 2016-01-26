<?php

namespace Aimpanel\SDK;

use GuzzleHttp;

class ApiClient
{

    public $hostname, $port, $username, $password;
    public $link;
    public $token;
    public $guzzle;
    public $debug = false;
    public $log;
    public $api_prefix = "/api/v1/";

    function http($method, $href, $args)
    {
        return $this->guzzle->request($method, $this->link . $href, ['json' => $args, 'headers' => ['Authorization' => $this->token]]);
    }

    function http_json($method, $href, $args)
    {
        return json_decode($this->http($method, $href, $args)->getBody());
    }

    function __construct($args)
    {
        if (isset($args["debug"]))
        {
            $this->debug = $args["debug"];
            $this->logAppend("Log started");
        }
        $required = ["hostname", "port", "username", "password"];
        foreach ($required as $req)
        {
            if (isset($args[$req]))
            {
                $this->$req = $args[$req];
            } else
            {
                throw new \RuntimeException("You must provide $req field first");
            }
        }
        $this->link = $this->hostname . ":" . $this->port . $this->api_prefix;
        $this->guzzle = new GuzzleHttp\Client();
        $this->getToken();
    }

    function __destruct()
    {
        if ($this->debug)
        {
            echo $this->log;
        }
    }

    function logAppend($text)
    {
        $this->log .= time() . " " . $text . PHP_EOL;
    }

    function getToken()
    {
        $req = $this->guzzle->request('POST', $this->hostname . ":" . $this->port . $this->api_prefix . "auth/login", [
            'json' => ['username' => $this->username, 'password' => $this->password]
        ]);
        $raw = $req->getBody();
        if ($this->debug)
        {
            $this->logAppend("Auth response");
            $this->logAppend($raw);
        }
        $result = json_decode($raw);
        if ($result->error && isset($result->error_msg))
        {
            throw new \RuntimeException($result->error_msg);
        } else
        {
            $this->token = $result->token;
        }
    }

}
