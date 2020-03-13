<?php

require '../../vendor/autoload.php';

require_once '../Routing.php';
require_once '../Dispatcher.php';
require_once '../controllers.php';



session_start();
$url= $_GET['action'];
dispatch($routing,$url);
