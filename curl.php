<?php

function get_method($url, $id=null){
  // persiapkan curl
  $ch = curl_init(); 

  if ($id != null) {
    // set url
    $url = $url . $id;
  }
  // set url 
  curl_setopt($ch, CURLOPT_URL, $url);
  
  // set user agent    
  curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

  // return the transfer as a string 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

  // $output contains the output string 
  $response = curl_exec($ch); 
  $response = json_decode($response, TRUE);

  // tutup curl 
  curl_close($ch);      

  // mengembalikan hasil curl
  return $response;
}

function post_method($url, $data=null) {
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

  // execute!
  $response = curl_exec($ch);

  // close the connection, release resources used
  curl_close($ch);

  return $response;
}


?>