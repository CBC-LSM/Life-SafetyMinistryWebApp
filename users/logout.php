<?php
/**
 * logout.php
 *
 * @package default
 */


require_once '../database/load.php';
if (!$session->logout()) {redirect("index.php");}
?>
