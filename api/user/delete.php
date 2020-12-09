<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
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
    $user->FName = $data->Fname;
    $user->LName = $data->LName;
    $user->phone = $data->phone;

    // delete user
    if($user->delete()) {
        echo json_encode(
            array("message" => "user deleted")
        );
    } else {
        echo json_encode(
            array("message" => "user not deleted")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to delete user. Data is incomplete."));
}

?>