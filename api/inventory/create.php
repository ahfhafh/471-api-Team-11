<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
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

if (
    (!empty($data->item_id) || ($data->item_id == "0"))
) {
    $inventory->item_id = $data->item_id;

    // create inventory
    if($inventory->create()) {
        echo json_encode(
            array("message" => "Inventory created")
        );
    } else {
        echo json_encode(
            array("message" => "Inventory not created")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to create inventory. Data is incomplete."));
}

?>