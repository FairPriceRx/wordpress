<?php

$client_test_data = array (
  'order_id' => '1333',
  'order_date' => '01/27/2020',
  'order_total' => '17.00',
  'order_subtotal' => '7.00',
  'order_shipping_cost' => '10.00',
  'order_payment_method' => 'Direct bank transfer',
  'order_customer_email' => 'info@fairpricerx.com',
  'order_customer_phone' => '95465423',
  'order_customer_name' => 'Alyona',
  'order_customer_surname' => 'H',
  'order_customer_address' => 'Test street',
  'order_customer_country' => 'Ukraine',
  'order_customer_city' => 'Kyiv',
  'order_customer_zip' => '023333',
  'order_items' => 
  array (
    0 => 
    array (
      'item_name' => 'Flagyl 250 mg - 20 tablets (Generic Metronidazole)',
      'item_quantity' => 1,
      'item_total' => '7',
    ),
  ),
);

$send_data = json_encode($client_test_data);


$method="POST";             
$serv_addr = '35.175.48.5'; 
$serv_port = 8080;          
$serv_page = 'create_order';
$timelimit = 2;

$data = array(
  'request' => $send_data,
);

$post_data_text = '';
  foreach ($data AS $key => $val)
    $post_data_text .= $key.'='.urlencode($val).'&';

$post_data_text = substr($post_data_text, 0, -1);
// заголовок для метода POST 
$post_headers = array('POST /'.$serv_page.' HTTP/1.1',
             'Host: '.$serv_addr,
             'Content-type: application/x-www-form-urlencoded charset=utf-8',
             'Content-length: '.strlen($post_data_text),
             'Accept: */*',
             'Connection: Close',
             '');

if ($method=="POST") {
  $headers=$post_headers; 
} 


$headers_txt = '';
foreach ($headers AS $val) {
  $headers_txt .= $val.chr(13).chr(10);
}

if ($method=="POST") {
  $headers_txt = $headers_txt.$post_data_text.chr(13).chr(10).chr(13).chr(10);
}

$sp = fsockopen($serv_addr, $serv_port, $errno, $errstr, $timelimit);

if (!$sp)
  exit('Error: '.$errstr.' #'.$errno);

  $response = fwrite($sp, $headers_txt);


$server_answer = '';
$server_header= '';   

$start = microtime(true);
$header_flag = 1;
while(!feof($sp) && (microtime(true) - $start) < $timelimit) {
  if ($header_flag == 1) {
    $content = fgets($sp, 4096);
    if ($content === chr(13).chr(10)) 
      $header_flag = 0;
    else
      $server_header .= $content;
  }
  else {
      $server_answer .= fread($sp, 4096);
  }
}

 
 fclose($sp);     

  // echo $headers_txt;
  var_export($server_answer);
?>
