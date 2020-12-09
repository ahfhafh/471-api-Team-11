<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/discount.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$discount = new discount($db);
  
// query products
$stmt = $discount->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $discounts_arr=array();
    $discounts_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $discount_discount=array(
            "discount_id" => $discount_id,
            "store" => $store,
            "name" => $name,
        );
  
        array_push($discounts_arr["data"], $discount_discount);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($discounts_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No discounts found.")
    );
}