<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
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


if (
    (!empty($data->department_id) || ($data->department_id == "0"))
) {
    // set department_id
    $department->department_id = $data->department_id;

    // delete department
    if($department->delete()) {
        echo json_encode(
            array("message" => "Department deleted")
        );
    } else {
        echo json_encode(
            array("message" => "Department not deleted")
        );
    }
} else {
    // set response code - 400 bad request
    http_response_code(400);
  
    // incomplete data
    echo json_encode(array("message" => "Unable to delete department. Data is incomplete."));
}

?>