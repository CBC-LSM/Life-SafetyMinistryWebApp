<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */

$dayofweek = date('l'); // day of week
$result    = date('Y-m-d', strtotime(($day - $dayofweek).' day', strtotime($date)));

echo $dayofweek;
die();