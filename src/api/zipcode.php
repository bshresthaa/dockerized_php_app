
<?php

$zip = urlencode($_GET['zipcode']); 
$url = "https://nominatim.openstreetmap.org/search?postalcode=$zip&country=United%20States&format=jsonv2";

//initialize curl
$ch = curl_init(); 

curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_USERAGENT, "getzicode/1.0");
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Accept-Language: en-US,en;q=0.9"]); 
$result = curl_exec($ch);
echo $result; 
curl_close($ch); 
?>