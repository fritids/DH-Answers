<?php
/**
 * Plugin Name: Twitter Notification
 * Plugin Description: Sends tweets to a specific Twitter account when a new topic is created.  Based on Post Notification by Thomas Klaiber.
 * Author: Joseph Gilbert
 * Author URI: http://lib.virginia.edu/scholarslab/
 * Plugin URI: http://lib.virginia.edu/scholarslab/
 * Version: 0.1
 */
 
function tweet_new_topic() {
	//global $bbdb, $bb_table_prefix, $topic_id;
	
	//$t_title = get_topic_title($topic_id);
	
	// TODO: can we use a URL shoterner?
	//$t_link = get_topic_link($topic_id);
	
	//$message = "New topic at DH Q&A: \"".$t_title."\" ".$t_link;
	//$message = "New topic posted at DH Q&A.";
	
	$message = "new #dhqa topic ($t_link): " . $t_title;
	if (strlen($message)>140) {$message = substr($message,0,139) . '…';}

	// Set username and password
	$username = 'adhoqatest';
	$password = 'Answ3rs';

	// do a simple command-line curl with the status
	// TODO: check return status
	exec("curl -u $username:$password -d status=" . escapeshellarg($message) . "http://api.twitter.com/1/statuses/update.json", $output, $return);

	/*
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
	curl_setopt($ch, CURLOPT_POST, 1);
	$host = 'http://twitter.com/statuses/update.xml?source=DHQA&status='. urlencode(stripslashes(urldecode($message)));
	curl_setopt($ch, CURLOPT_URL, $host);
	$result = curl_exec($ch);
	curl_close($ch);
	*/

}
add_action('bb_new_topic', 'tweet_new_topic');
?>