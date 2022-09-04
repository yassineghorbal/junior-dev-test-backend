<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

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
