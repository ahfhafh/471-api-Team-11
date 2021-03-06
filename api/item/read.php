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
  
// query products
$stmt = $item->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $items_arr=array();
    $items_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $item_item=array(
            "item_id" => $item_id,
            "type" => $type,
            "description" => $description,
            "price" => $price,
            "in-stock" => $in_stock,
            "brand" => $brand
        );
  
        array_push($items_arr["data"], $item_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($items_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No items found.")
    );
}