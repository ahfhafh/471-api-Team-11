<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/section.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$section = new section($db);

// get data
$data = json_decode(file_get_contents("php://input"));

// set name
$section->name = $data->name;
$section->inventory = $data->inventory;

// update section
if($section->update()) {
    echo json_encode(
        array("message" => "Section updated")
    );
} else {
    echo json_encode(
        array("message" => "Section not updated")
    );
}

?>