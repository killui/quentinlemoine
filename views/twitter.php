<?php
	session_start();
	require_once "../library/twitter_oauth.php"; //Path to twitteroauth library

	$twitteruser = "lemoine_quentin";
	$notweets = 1;
	$consumerkey = "026Wk3yOo6hcnquEThLMQ";
	$consumersecret = "sasyjgSe9ivAVtv4RnVz9j4zQJ2x95LcTgyRxz4rE";
	$accesstoken = "405870892-c9FqFtIy6e0lYQz0lGK0LJNe9gGhtbPWKNxymu2c";
	$accesstokensecret = "fWiTwp3SiCuvssugYlrxilo0idj6I78hQDCqFMQmXHuf8";
	 
	function getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
	  return $connection;
	}
	 
	$connection = getConnectionWithAccessToken($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);
	 
	$tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$twitteruser."&count=".$notweets);
	
	echo "<section>".json_encode($tweets)."</section>";
	echo "failed";
?>