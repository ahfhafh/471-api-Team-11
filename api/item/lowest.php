<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/item.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$item = new item($db);

// get item
$item->find_lowest();

if($item->in_stock!=null){
    // create array
    $item_arr = array(
    'item_id' => $item->item_id,
    'brand' => $item->brand,
    'price' => $item->price,
    'description' => $item->description,
    'in_stock' => $item->in_stock,
    'type' => $item->type,
    'section' => $item->section
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // no products found
    echo json_encode(
        array("message" => "Lowest priced item:")
    );

    // make JSON
    print_r(json_encode($item_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "Item cannot be found.")
    );
}
