<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/updates.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$updates = new updates($db);
  
// get ID
$updates->item_added = isset($_GET['item_added']) ? $_GET['item_added'] : die();

// get updates
$updates->search();

// create array
$updates_arr = array(
    'admin_id' => $updates->admin_id,
    'inventory' => $updates->inventory,
    'item_added' => $updates->item_added
);

// set response code - 200 OK
http_response_code(200);

// make JSON
print_r(json_encode($updates_arr));
