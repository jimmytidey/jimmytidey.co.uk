
<?

$docRoot = getenv("DOCUMENT_ROOT");
include_once ($docRoot.'/fragments/header.php');

//ensure DB connection 
include_once ($docRoot.'/code/dbConnect.php');

$guid= '9202a8c04000641f80000000001fce39';

$url = 'http://www.freebase.com/experimental/topic/standard/'.$guid;




//print_r($buffer);

$date =  strtotime("1 December 1901");

echo $date."is this thing on yet?";

$url = 'http://en.wikipedia.org/w/api.php?action=opensearch&search=winsto&format=json&callback=spellcheck'; 

$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL, $url);
curl_setopt($curl_handle, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);	
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);

$resultarray = json_decode($buffer, true); #true:give us the json struct as an array


print_r($resultarray); 
 


include_once ($docRoot.'/fragments/footer.php');
?>