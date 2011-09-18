
<?

$docRoot = getenv("DOCUMENT_ROOT");
include_once ($docRoot.'/fragments/header.php');

//ensure DB connection 
include_once ($docRoot.'/code/dbConnect.php');

$guid= '9202a8c04000641f80000000001fce39';

$url = 'http://www.freebase.com/experimental/topic/standard/'.$guid;


$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL,$url);
$data  = curl_exec($curl_handle);
curl_close($curl_handle);



$resultarray = json_decode($data, true); #true:give us the json struct as an array
 


include_once ($docRoot.'/fragments/footer.php');
?>