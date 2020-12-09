<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/admin.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$admin = new admin($db);

// get data
$data = json_decode(file_get_contents("php://input"));

if (
    !empty($data->email)
) {
    $admin->email = $data->email;

    // create admin
    if($admin->create()) {
        echo json_encode(
            array("message" => "admin created")
        );
    } else {
        echo json_encode(
            array("message" => "admin not created")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to create admin. Data is incomplete."));
}

?>