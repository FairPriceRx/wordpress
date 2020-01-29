<?php
$file = file_get_contents("order_json_new.json");
$ch = curl_init('http://35.175.48.5:8080/create_order');

$post = array(
    'data' => '@' . $file,
);

curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$html = curl_exec($ch);
curl_close($ch);

echo '<pre>';
var_export($html);
