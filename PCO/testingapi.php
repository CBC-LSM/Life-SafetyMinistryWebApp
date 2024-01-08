<?php

require_once '../database/load.php';
require_once 'common.php';
require_once 'pcoFunctions.php';
require_once 'redisFunctions.php';
require_once 'redisConnection.php';

pcoCall($URL);

foreach ($datas as $data){
    echo ($data['relationships']['locations']['data'][0]['id']);
    die();
}