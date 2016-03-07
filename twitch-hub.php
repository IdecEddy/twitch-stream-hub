<?php

// here is the array of users that you will want to look for.
$users = array ('idecfilms',"wimlydoon","mcraeman", "mrgarrett2496" , "raging_koi" , "vostramosgaming");
$live_streams = array ();
$count = 0;
//we loop through the users if they are live we add them to the live_streams array.
foreach ($users as $user){
	$user_api_link = "https://api.twitch.tv/kraken/streams/" . $user;
	$user_api_text = file_get_contents($user_api_link);
	$user_api = json_decode($user_api_text);
	if(!is_null($user_api->stream->_id)){
		$stream_placeholder = array();
		array_push($stream_placeholder, $user_api->stream->channel->display_name);
		$stream_embed = "https://player.twitch.tv/?channel=" . strtolower($user_api->stream->channel->display_name);
		array_push($stream_placeholder, $stream_embed); 		
		array_push($stream_placeholder, $user_api->stream->viewers);
		array_push($stream_placeholder, $count);
		array_push($live_streams, $stream_placeholder);
		$count++;
		}

}
?>

<?php 

// if we found a livestream we display the defualt stream if we have a get value of stream and that value is a number we play that stream and that number is also in range of the number of streams we have in our array
//we play that stream.
if(isset($live_streams[0])){
?>
<div id="stream_div">
	<?php
	if(isset($_GET['stream']))
	{
		if(is_numeric($_GET['stream']))
		{
			if($_GET['stream'] <= (count($live_streams)-1) && $_GET['stream'] >= 0)
			{
				$embed_code = "<iframe id='stream_frame' src='" . strtolower($live_streams[$_GET['stream']][1]) . "' frameborder='0' scrolling='no' height='378' width='620' float='left'></iframe>";
			} else{
        		$embed_code = "<iframe id='stream_frame' src='" . $live_streams[0][1] . "' frameborder='0' scrolling='no' height='378' width='620' float='left'></iframe>";
			}
		}else{
	        $embed_code = "<iframe id='stream_frame' src='" . $live_streams[0][1] . "' frameborder='0' scrolling='no' height='378' width='620' float='left'></iframe>";
		}
	}else{
		$embed_code = "<iframe id='stream_frame' src='" . $live_streams[0][1] . "' frameborder='0' scrolling='no' height='378' width='620' float='left'></iframe>";
	}
	//display the streams
	echo $embed_code;
	
	?>
	</div>
	<?php //display names and viewers of other streams?>
	<div id='streams'>
	<?php
    foreach($live_streams as $stream){
    	//change this link to where the $_GET['stream'] will be IE the page this app will be on
	?>
		<a href="index.php?stream=<?php echo $stream[3]; ?>">
		<div id='stream'>
			<img id='live_icon' src='web_icons/1457364222'></img>
			<p id='name' float='left'> <?php echo $stream[0];?>  </p> 
			<p id='views' float='right'> <?php echo $stream[2];?> </p>
			<img id='viewer_icon' src='web_icons/1457363792'></img>
		</div>
	</a>
		<br />
	<?php 
	}

	?>
	</div>
<?php } ?>




