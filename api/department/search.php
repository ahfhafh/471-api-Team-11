<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/department.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$department = new department($db);
  
// get ID
$department->department_id = isset($_GET['department_id']) ? $_GET['department_id'] : die();

// get department
$department->search();

if($department->name!=null){
    // create array
    $department_arr = array(
    'department_id' => $department->department_id,
    'name' => $department->name,
    'store' => $department->store,
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // make JSON
    print_r(json_encode($department_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "Department cannot be found.")
    );
}