<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
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
    (!empty($data->item_added) || ($data->item_added == "0"))
) {
    // set item_added
    $updates->item_added = $data->item_added;

    // delete updates
    if($updates->delete()) {
        echo json_encode(
            array("message" => "Updates deleted")
        );
    } else {
        echo json_encode(
            array("message" => "Updates not deleted")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to delete updates. Data is incomplete."));
}