<?php

require 'vendor/autoload.php';

//Create instance with your credentials
$aimpanel = new Aimpanel\SDK\Api([
    "hostname" => "example.com",
    "port" => 3131,
    "username" => "admin",
    "password" => "mysecretpassword"
]);

//list all Minecraft servers
$mc_servers = $aimpanel->minecraft->list_all();
foreach ($mc_servers as $mc)
{
    echo "ID " . $mc->id . ", state: " . $mc->state . PHP_EOL;
}

//Turn on Minecraft server with ID 1
print_r($aimpanel->minecraft->turn_on(1));

//Wait a while
echo "Waiting 5 seconds" . PHP_EOL;
sleep(5);

//list all Minecraft servers again
$mc_servers = $aimpanel->minecraft->list_all();
foreach ($mc_servers as $mc)
{
    echo "ID " . $mc->id . ", state: " . $mc->state . PHP_EOL;
}

//Turn off Minecraft server with ID 1
print_r($aimpanel->minecraft->turn_off(1));

//Wait a while
echo "Waiting 5 seconds" . PHP_EOL;
sleep(5);

//list all Minecraft servers once again
$mc_servers = $aimpanel->minecraft->list_all();
foreach ($mc_servers as $mc)
{
    echo "ID " . $mc->id . ", state: " . $mc->state . PHP_EOL;
}