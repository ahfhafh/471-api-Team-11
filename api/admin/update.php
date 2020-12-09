<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
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

// set id of the items to be added
$admin->admin_id = $data->admin_id;

$admin->email = $data->email;

// update admin
if($admin->update()) {
    echo json_encode(
        array("message" => "admin updated")
    );
} else {
    echo json_encode(
        array("message" => "admin not updated")
    );
}

?>