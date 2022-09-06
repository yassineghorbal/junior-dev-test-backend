<?php
// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../config/Database.php');
include_once('../models/Product.php');

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();


// Instantiate Product object
$product = new Product($db);

// all products query
$result = $product->read();
// get row count
$count = $result->rowCount();

// check if any products
if ($count > 0) {
    // Product array
    $products_arr = array();
    $products_arr['data'] = array();

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $product_item = array(
            'id' => $id,
            'sku' => html_entity_decode($sku),
            'name' => html_entity_decode($name),
            'price' => $price,
            'attribute' => html_entity_decode($attribute),
            'value' => html_entity_decode($value),
            'unit' => html_entity_decode($unit),
        );

        // push to 'data'
        array_push($products_arr['data'], $product_item);
    }

    // turn into json & output
    echo json_encode($products_arr);
} else {
    // no products
    echo json_encode(
        array('message' => 'no products')
    );
}
