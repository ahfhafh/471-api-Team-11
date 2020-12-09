<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/accesses.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$accesses = new accesses($db);
  
// get ID
$accesses->accesses_id = isset($_GET['accesses_id']) ? $_GET['accesses_id'] : die();

// get accesses
$accesses->search();

// create array
$accesses_arr = array(
'accesses_id' => $accesses->accesses_id,
'admin_id' => $accesses->admin_id,
'store_id' => $accesses->store_id,
'item_obtained' => $accesses->item_obtained,
);

// set response code - 200 OK
http_response_code(200);

// make JSON
print_r(json_encode($accesses_arr));
