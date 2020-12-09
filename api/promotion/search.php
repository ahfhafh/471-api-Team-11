<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/promotion.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$promotion = new promotion($db);
  
// get ID
$promotion->promotion_id = isset($_GET['promotion_id']) ? $_GET['promotion_id'] : die();

// get promotion
$promotion->search();

if($promotion->name!=null){
    // create array
    $promotion_arr = array(
    "promotion_id" => $promotion->promotion_id,
    "date" => $promotion->date,
    "name" => $promotion->name,
    "item" => $promotion->item,
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // make JSON
    print_r(json_encode($promotion_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "Promotion cannot be found.")
    );
}