<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/shopping_list_items.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$shopping_list_items = new shopping_list_items($db);

// get data
$data = json_decode(file_get_contents("php://input"));

// set id of the shopping_list_items to be edited
$shopping_list_items->id = $data->id;

$shopping_list_items->item_id = $data->item_id;
$shopping_list_items->list_id = $data->list_id;

// update shopping_list_item
if($shopping_list_items->update()) {
    echo json_encode(
        array("message" => "Shopping_list_item updated")
    );
} else {
    echo json_encode(
        array("message" => "Shopping_list_item not updated")
    );
}

?>