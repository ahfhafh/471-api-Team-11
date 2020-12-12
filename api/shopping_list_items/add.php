<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/shopping_list_items.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$shopping_list_items = new shopping_list_items($db);
  
// get info
$shopping_list_items->description = isset($_GET['description']) ? $_GET['description'] : die();
$shopping_list_items->list_id = isset($_GET['list_id']) ? $_GET['list_id'] : die();

// create item
if($shopping_list_items->add_item()) {
    echo json_encode(
        array("message" => "Item created")
    );
} else {
    echo json_encode(
        array("message" => "Item not created")
    );
}