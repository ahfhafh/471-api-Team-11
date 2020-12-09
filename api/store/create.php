<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/store.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$store = new store($db);

// get data
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->location) &&
    !empty($data->name)
) {
    $store->name = $data->name;
    $store->location = $data->location;

    // create store
    if($store->create()) {
        echo json_encode(
            array("message" => "Store created")
        );
    } else {
        echo json_encode(
            array("message" => "Store not created")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to create store. Data is incomplete."));
}

?>