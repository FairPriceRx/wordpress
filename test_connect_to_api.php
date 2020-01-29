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

$ch = curl_init('http://35.175.48.5');
curl_setopt($ch,CURLOPT_PORT, 8080);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $send_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($send_data))
);

$result = curl_exec($ch);

if (curl_errno($ch)) {
    print "Error: " . curl_error($ch);
} else {

    echo '<pre>';
    var_dump($result);
    curl_close($ch);
}

die;
