<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/inventory.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$inventory = new inventory($db);

// get data
$data = json_decode(file_get_contents("php://input"));

// set inventory_id of the inventory to be edited
$inventory->inventory_id = $data->inventory_id;

$inventory->item_id = $data->item_id;

// update inventory
if($inventory->update()) {
    echo json_encode(
        array("message" => "Inventory updated")
    );
} else {
    echo json_encode(
        array("message" => "Inventory not updated")
    );
}

?>