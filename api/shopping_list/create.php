<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/shopping_list.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$shopping_list = new shopping_list($db);

// get data
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->name)
) {
    $shopping_list->name = $data->name;
    $shopping_list->item_id = $data->item_id;

    // create shopping_list
    if($shopping_list->create()) {
        echo json_encode(
            array("message" => "shopping_list created")
        );
    } else {
        echo json_encode(
            array("message" => "shopping_list not created")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to create shopping_list. Data is incomplete."));
}

?>