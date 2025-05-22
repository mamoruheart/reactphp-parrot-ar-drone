<?php

$loader = require_once __DIR__.'/../vendor/autoload.php';
$loader->add('Codeguru\ArDrone', __DIR__.'/../src/');

$client = new \Codeguru\ArDrone\Client();

$client->createRepl();

$client->start();
