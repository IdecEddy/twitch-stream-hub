<?php 
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once('../includes/init.php');
require_once('../includes/live_stream_cash.php');


$live = Live_streams::find_all();
echo json_encode($live);


?>
