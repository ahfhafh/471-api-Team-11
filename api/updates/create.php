<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/updates.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$updates = new updates($db);

// get data
$data = json_decode(file_get_contents("php://input"));

if (
    (!empty($data->admin_id) || ($data->admin_id == "0")) &&
    (!empty($data->inventory) || ($data->inventory == "0"))
) {
    $updates->admin_id = $data->admin_id;
    $updates->inventory = $data->inventory;

    // create updates
    if($updates->create()) {
        echo json_encode(
            array("message" => "Updates created")
        );
    } else {
        echo json_encode(
            array("message" => "Updates not created")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to create Updates. Data is incomplete."));
}
