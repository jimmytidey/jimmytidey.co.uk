<?

function get_lifespan($id)
{
	$url = 'http://www.freebase.com/experimental/topic/standard'.$id;
	
	
	function escapeJavaScriptText($string)
	{
		return str_replace("\n", '\n', str_replace('"', '\"', addcslashes(str_replace("\r", '', (string)$string), "\0..\37'\\")));
	}
	
	
	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL, $url);
	curl_setopt($curl_handle, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);	
	$buffer = curl_exec($curl_handle);
	curl_close($curl_handle);
	
	$nested_array = json_decode($buffer, true); 
	
	$info['start'] = $nested_array['result']['properties']['/people/person/date_of_birth']['values'][0]['value'];
	$info['end'] = $nested_array['result']['properties']['/people/deceased_person/date_of_death']['values'][0]['value'];
	$info['title'] = escapeJavaScriptText($nested_array['result']['text']);
	$info['description'] = escapeJavaScriptText($nested_array['result']['description']);  
	



	
	if (empty($info['start'])) 
	{
		$info['start'] =$nested_array['result']['properties']['/time/event/start_date']['values'][0]['text']; 
	}
	
	if (empty($info['end'])) 
	{
		$info['end'] =$nested_array['result']['properties']['/time/event/end_date']['values'][0]['text']; 
	}	
	
	return $info;
}

$info = get_lifespan($_GET['id']);


echo $_GET['callback'].'(';
echo json_encode($info).')'; 

