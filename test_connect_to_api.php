<?php

$client_data = array (
  'order_id' => $order->get_order_number(),
  'order_date' => $order->get_date_created()->format ('m/d/Y'),
  'order_total' => is_callable(array($order, 'get_total')) ? $order->get_total() : $order->order_total,
  'order_subtotal' => $order->get_subtotal(),
  'order_shipping_cost' => '10',
  'order_payment_method' => wp_kses_post( $order->get_payment_method_title() ),
  'order_customer_email' => $order->billing_email,
  'order_customer_phone' => $order->billing_phone,
  'order_customer_name' => $order->billing_first_name,
  'order_customer_surname' => $order->billing_last_name,
  'order_customer_address' => 'Test street',
  'order_customer_country' => $order->billing_country,
  'order_customer_city' => $order->billing_city,
  'order_customer_zip' => $order->billing_postcode,
);

$order_items = $order->get_items();

foreach ($order_items as $item_id => $item_data) {
    // Get the product name
    $product_name = $item_data['name'];
    // Get the item quantity
    $item_quantity = $order->get_item_meta($item_id, '_qty', true);
    // Get the item line total
    $item_total = $order->get_item_meta($item_id, '_line_total', true);

    $client_data['order_items'][] = array(
	'item_name' => $product_name,
	'item_quantity' => $item_quantity,
	'item_total' => $item_total,
    );
}

$send_data = json_encode($client_data);

echo '<pre>';
echo '<b style="font-weight: 600;">client data array:</b>';
echo '<br>';
var_export($client_data);
echo '</pre>';

echo '<br>';
echo '<b style="font-weight: 600;">client data json:</b>';
echo '<br>';
echo '<br>';
echo $send_data;

$url = 'http://ipv4balancer-1946574705.us-east-1.elb.amazonaws.com/paypal/create_order';

echo '<br>';
echo '<br>';
echo '<b style="font-weight: 600;">connecting to: http://ipv4balancer-1946574705.us-east-1.elb.amazonaws.com/paypal/create_order</b>';

$data = wp_remote_post(
	$url, 
	array(
		'headers'   => 
			array(
				'Content-Type' => 'application/json; charset=utf-8'
			), 
		'body'      => $send_data, 
		'method'    => 'POST'
	)
); 

echo '<pre>';
echo '<b style="font-weight: 600;">response:</b>';
echo '<br>';
var_export($data);
echo '</pre>';
