<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/accesses.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$accesses = new accesses($db);

// get data
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->admin_id) &&
    !empty($data->store_id) &&
    (!empty($data->item_obtained) || ($data->item_obtained == "0"))
) {
    $accesses->admin_id = $data->admin_id;
    $accesses->store_id = $data->store_id;
    $accesses->item_obtained = $data->item_obtained;

    // create accesses
    if($accesses->create()) {
        echo json_encode(
            array("message" => "Accesses created")
        );
    } else {
        echo json_encode(
            array("message" => "Accesses not created")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to create accesses. Data is incomplete."));
}

?>