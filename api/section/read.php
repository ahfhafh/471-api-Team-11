<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/section.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$section = new section($db);
  
// query products
$stmt = $section->read();
$num = $stmt->rowCount();
  
// check if record found
if($num > 0){
  
    // products array
    $sections_arr=array();
    $sections_arr["data"]=array();
  
    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        extract($row);
  
        $section_section=array(
            "name" => $name,
            "inventory" => $inventory
        );
  
        array_push($sections_arr["data"], $section_section);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($sections_arr);
}
  
else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "No sections found.")
    );
}