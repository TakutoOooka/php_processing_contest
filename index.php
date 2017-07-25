<?php
date_default_timezone_set('Asia/Tokyo');
define("PROJECT_ROOT", dirname(__FILE__));
require_once(dirname(__FILE__) . '/library/Dispatcher.php');

$dispatcher = new Dispatcher();
$dispatcher->dispatch();
