<?php
// Headers
require '../config/headers.php';

include_once '../config/Database.php';
include_once '../models/Product.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$product = new Product($db);

// Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$product->sku = $data->sku;
$product->name = $data->name;
$product->price = $data->price;
$product->attribute = $data->attribute;
$product->value = $data->value;
$product->unit = $data->unit;
$product->created_at = date('Y-m-d H:i:s');


// create product
if ($product->create()) {
    echo json_encode(
        array('messeage' => 'Product created')
    );
} else {
    echo json_encode(
        array('messeage' => 'Product not created')
    );
}
