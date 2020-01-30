<?php

$url = 'http://35.175.48.5:8080/create_order';
$t_json = '{"order_id":"1333","order_date":"01\/27\/2020","order_total":"17.00","order.subtotal":"7.00","order.shipping_cost":"10.00","order_payment_method":"Direct bank transfer","order_customer_email":"info@fairpricerx.com","order_customer_phone":"95465423","order_customer_name":"Alyona","order_customer_surname":"H","order_customer_address":"Test street","order_customer_country":"Ukraine","order_customer_city":"Kyiv","order_customer_zip":"023333","order_items":[{"item_name":"Flagyl 250 mg - 20 tablets (Generic Metronidazole)","item_quantity":1,"item_total":"7"}]}';

$data = wp_remote_post(
	$url, 
	array(
		'headers'   => 
			array(
				'Content-Type' => 'application/json; charset=utf-8'
			), 
		'body'      => $t_json, 
		'method'    => 'POST'
	)
); 

var_export($data);
