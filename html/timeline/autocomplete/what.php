
<?

$docRoot = getenv("DOCUMENT_ROOT");
include_once ($docRoot.'/fragments/header.php');

//ensure DB connection 
include_once ($docRoot.'/code/dbConnect.php');

$guid= '9202a8c04000641f80000000001fce39';

$url = 'http://www.freebase.com/experimental/topic/standard/'.$guid;


$curl_handle=curl_init();
curl_setopt($curl_handle,CURLOPT_URL, $url);
curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);	
$buffer = curl_exec($curl_handle);
curl_close($curl_handle);

//print_r($buffer);


$resultarray = json_decode($buffer, true); #true:give us the json struct as an array
 
$objTmp = (object) array('aFlat' => array());

array_walk_recursive($resultarray, create_function('&$v, $k, &$t', '$t->aFlat[] = $v;'), $objTmp);

var_dump($objTmp->aFlat);
 




 


include_once ($docRoot.'/fragments/footer.php');
?>