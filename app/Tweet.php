<?php
namespace Emutoday;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
  public function get_feed()
  {
    // keys from your app
    include(app_path().'/Http/Requests/oauth.php');

    // we are going to use "user_timeline"
    $twitter_timeline = "user_timeline";

    // specify number of tweets to be shown and twitter username
    // for example, we want to show 20 of Taylor Swift's twitter posts
    $request = array(
      'count' => '4',
      'screen_name' => 'EMU_Swoop'
    );

    //////////////////////////////////////
    // put oauth values in one oauth array variable
    $oauth = array(
      'oauth_consumer_key' => $consumer_key,
      'oauth_nonce' => time(),
      'oauth_signature_method' => 'HMAC-SHA1',
      'oauth_token' => $oauth_access_token,
      'oauth_timestamp' => time(),
      'oauth_version' => '1.0'
    );

    // combine request and oauth in one array
    $oauth = array_merge($oauth, $request);

    // make base string
    $baseURI="https://api.twitter.com/1.1/statuses/$twitter_timeline.json";
    $method="GET";
    $params=$oauth;

    $r = array();
    ksort($params);
    foreach($params as $key=>$value){
      $r[] = "$key=" . rawurlencode($value);
    }
    $base_info = $method."&" . rawurlencode($baseURI) . '&' . rawurlencode(implode('&', $r));
    $composite_key = rawurlencode($consumer_secret) . '&' . rawurlencode($oauth_access_token_secret);

    // get oauth signature
    $oauth_signature = base64_encode(hash_hmac('sha1', $base_info, $composite_key, true));
    $oauth['oauth_signature'] = $oauth_signature;
    //////////////////////////////////////
    // make request
    // make auth header
    $r = 'Authorization: OAuth ';

    $values = array();
    foreach($oauth as $key=>$value){
      $values[] = "$key=\"" . rawurlencode($value) . "\"";
    }
    $r .= implode(', ', $values);

    // get auth header
    $header = array($r, 'Expect:');

    // set cURL options
    $options = array(
      CURLOPT_HTTPHEADER => $header,
      CURLOPT_HEADER => false,
      CURLOPT_URL => "https://api.twitter.com/1.1/statuses/$twitter_timeline.json?". http_build_query($request),
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_SSL_VERIFYPEER => false,
      CURLOPT_SSL_VERIFYHOST => false
    );
    //////////////////////////////////////
    // retrieve the twitter feed
    $feed = curl_init();
    curl_setopt_array($feed, $options);
    $json = curl_exec($feed);
    curl_close($feed);

    // decode json format tweets
    $tweets=json_decode($json, true);

    //////////////////////////////////////
    return $tweets;
  }
}
