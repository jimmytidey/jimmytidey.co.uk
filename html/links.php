<?
// jSON URL which should be requested
 
$feed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
$feed .= '<rss version="2.0">';
$feed .= '<channel>';
$feed .= '<title>Your RSS</title>';
$feed .= '<link>http://www.yourwebsite.com</link>';
$feed .= '<description>Describe Website</description>';
$feed .= '<language>en-us</language>';
$feed .= '<copyright>yourwebsite.com</copyright>';
 
 
 
$ch = curl_init();

// Set query data here with the URL
curl_setopt($ch, CURLOPT_URL, 'https://api.twitter.com/1/statuses/user_timeline.json?screen_name='.$_GET['screen_name']); 

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, '3');
$content = trim(curl_exec($ch));
curl_close($ch);
$content = json_decode($content, true); 

foreach($content as $tweet) { 
    $tweet_text_array = explode('http://', $tweet['text']);
   
    if(isset($tweet_text_array[1])) { 
        
        $url = "http://" . $tweet_text_array[1];
        
        $split = explode(' ', $url);
        $clean = $split[0];  
        $feed .= '<item>';
        $feed .= "<title>$clean</title>";
        $feed .= "<description>$clean</description>";
        $feed .= "<link>". $clean ."</link>";
        $feed .= '</item>';           
    }
    
 

} 


$feed .= '</channel>';
echo $feed;

?>