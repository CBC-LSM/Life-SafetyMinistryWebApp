<?php

function redirect($url, $permanent = false) {
	if (headers_sent() === false) {
		header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
	}

	exit();
}

function getTime()
{
 return array_sum(explode(" ",microtime()));  
}

