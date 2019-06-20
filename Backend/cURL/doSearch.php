<?php
$curlSES=curl_init(); 
$key = "AIzaSyAXx0zv_eIgtZgiBRrlCpsG9m6mIa3Lg5s";
$url = "https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=5&order=viewCount&q=prova&regionCode=it&type=video&videoDefinition=high&videoEmbeddable=true&key=AIzaSyAXx0zv_eIgtZgiBRrlCpsG9m6mIa3Lg5s";
//step1
//step2
curl_setopt($curlSES,CURLOPT_URL,$url);
curl_setopt($curlSES,CURLOPT_RETURNTRANSFER,true);
curl_setopt($curlSES, CURLOPT_SSL_VERIFYPEER, false); 
curl_setopt($curlSES, CURLOPT_SSL_VERIFYHOST, false); 
curl_setopt($curlSES,CURLOPT_HEADER, false); 
//step3
$result=curl_exec($curlSES);
//step4
curl_close($curlSES);
//step5
$object = json_decode($result);
print_r($result);
?>