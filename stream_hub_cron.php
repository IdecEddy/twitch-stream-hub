#!/usr/bin/php

<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);

require_once("../includes/init.php"); 
require_once("../includes/live_stream_cash.php");


// here is the array of users that you will want to look for.
$users = array ( 'imaqtpie','idecfilms',"wimlydoon","mcraeman", "mrgarrett2496" , "raging_koi" , "vostramosgaming");
$live_streams = array ();
$count = 0;
//we loop through the users if they are live we add them to the live_streams array.
foreach ($users as $user){
	$user_api_link = "https://api.twitch.tv/kraken/streams/" . $user;
	$user_api_text = file_get_contents($user_api_link);
	$user_api = json_decode($user_api_text);
	if(!is_null($user_api->stream)){
		$stream_embed = "<iframe src='https://player.twitch.tv/?channel=" . strtolower($user_api->stream->channel->display_name) . "' frameborder='0' scrolling='no' height='378' width='620'></iframe>";
		array_push($live_streams, array('stream_display_name' => $user_api->stream->channel->display_name, 'embed_code' => $stream_embed, 'views' => $user_api->stream->viewers , 'pos' => $count)); 
		$count++;
		}

}
?>

<?php
Live_streams::clear_cash();
foreach($live_streams as $streams){
	$stream_to_add = new Live_streams;
	$stream_to_add->stream_display_name = $streams['stream_display_name'];
	$stream_to_add->embed_code 			= $streams['embed_code'];
	$stream_to_add->views 				= $streams['views'];
	$stream_to_add->pos 				= $streams['pos'];
	$stream_to_add->time				= time(); 
	if($stream_to_add->saves()){
		echo "we added it to the db.";
	}else{
		echo "nothing happend";
	}
}
?>



