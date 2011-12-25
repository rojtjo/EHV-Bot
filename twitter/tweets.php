<?php

function get_mentions(){
	require_once('./twitter/twitteroauth/twitteroauth.php');
	require_once('./twitter/config.php');

	/* Request access tokens from twitter */
	$access_token = array('oauth_token' => '437334727-1qcDl3G5Ydfhw91vgecaAbIErJ8AHXXjI3ChTpeY' , 'oauth_token_secret' => 'KO9XzYJkBJFCN4Sjr9zvUomjXPi85PhtlFl1KgSsgVw');

	/* Create a TwitterOauth object with consumer/user tokens. */
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

	/* If method is set change API call made. Test is called by default. */
	$content = $connection->get('statuses/mentions');

	/* Some example calls */
	//$connection->get('users/show', array('screen_name' => 'ehvbot'));
	//$connection->post('statuses/update', array('status' => date(DATE_RFC822)));
	//$connection->post('statuses/destroy', array('id' => 5437877770));
	//$connection->post('friendships/create', array('id' => 9436992));
	//$connection->post('friendships/destroy', array('id' => 9436992));

	/* Include HTML to display on the page */
	
	return $content;
	
}

$content = get_mentions();