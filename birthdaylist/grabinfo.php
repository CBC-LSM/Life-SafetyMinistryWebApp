<?php

require_once '../database/load.php';
require_once 'common.php';
require_once 'bdFunctions.php';
$results = pcoCallbirthday($URL);

$upandcoming = upcomingevents($results);