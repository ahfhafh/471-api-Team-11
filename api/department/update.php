<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Authorization, Access-Control-Allow-Methods, X-Requested-With");

// include database and object files
include_once '../config/database.php';
include_once '../objects/department.php';

// instantiate database
$database = new Database();
$db = $database->connect();

// initialize object
$department = new department($db);

// get data
$data = json_decode(file_get_contents("php://input"));

// set department_id of the department to be edited
$department->department_id = $data->department_id;

$department->store = $data->store;
$department->name = $data->name;

// update department
if($department->update()) {
    echo json_encode(
        array("message" => "Department updated")
    );
} else {
    echo json_encode(
        array("message" => "Department not updated")
    );
}

?>