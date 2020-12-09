<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/store.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$store = new store($db);
  
// get ID
$store->store_id = isset($_GET['store_id']) ? $_GET['store_id'] : die();

// get store
$store->search();

if($store->name!=null){
    // create array
    $store_arr = array(
    'store_id' => $store->store_id,
    'location' => $store->location,
    'name' => $store->name,
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // make JSON
    print_r(json_encode($store_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "Store cannot be found.")
    );
}