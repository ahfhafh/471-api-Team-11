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
  
// query products
$stmt = $department->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $departments_arr=array();
    $departments_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $department_department=array(
            "department_id" => $department_id,
            "store" => $store,
            "name" => $name,
        );
  
        array_push($departments_arr["data"], $department_department);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($departments_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No departments found.")
    );
}