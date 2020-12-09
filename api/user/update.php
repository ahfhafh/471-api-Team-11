<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$user = new user($db);

// get data
$data = json_decode(file_get_contents("php://input"));


if (
    !empty($data->email)
) {
    // set user
    $user->email = $data->email;
    $user->Fname = $data->Fname;
    $user->Lname = $data->Lname;
    $user->phone = $data->phone;

    // update user
    if($user->update()) {
        echo json_encode(
            array("message" => "user updated")
        );
    } else {
        echo json_encode(
            array("message" => "user not updated")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to update user. Data is incomplete."));
}

?>