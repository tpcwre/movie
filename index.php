<?php
date_default_timezone_set('PRC');
header('content-type:text/html;charset=utf-8');
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

function msg($arr){
	echo '<pre>';
		var_dump($arr);
	echo "</pre>";

}

define('APP_DEBUG',true);
define('APP_PATH','./Application/');
require '../ThinkPHP/ThinkPHP.php';


