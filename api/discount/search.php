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
  
// get ID
$discount->discount_id = isset($_GET['discount_id']) ? $_GET['discount_id'] : die();

// get discount
$discount->search();

if($discount->name!=null){
    // create array
    $discount_arr = array(
    'discount_id' => $discount->discount_id,
    'name' => $discount->name,
    'store' => $discount->store,
    'owner' => $discount->owner,
    'item_id' => $discount->item_id,
    'date_end' => $discount->date_end
    );
    
    // set response code - 200 OK
    http_response_code(200);

    // make JSON
    print_r(json_encode($discount_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "Discount cannot be found.")
    );
}