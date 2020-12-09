<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
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

// set accesses_id of the accesses to be edited
$accesses->accesses_id = $data->accesses_id;

$accesses->admin_id = $data->admin_id;
$accesses->store_id = $data->store_id;
$accesses->item_obtained = $data->item_obtained;

// update accesses
if($accesses->update()) {
    echo json_encode(
        array("message" => "Accesses updated")
    );
} else {
    echo json_encode(
        array("message" => "Accesses not updated")
    );
}

?>