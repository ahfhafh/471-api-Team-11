<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/inventory.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$inventory = new inventory($db);
  
// get ID
$inventory->inventory_id = isset($_GET['inventory_id']) ? $_GET['inventory_id'] : die();

// get inventory
$inventory->search();

if($inventory->item_id!=null){
    // create array
    $inventory_arr = array(
    'inventory_id' => $inventory->inventory_id,
    'item_id' => $inventory->item_id
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // make JSON
    print_r(json_encode($inventory_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "Inventory cannot be found.")
    );
}