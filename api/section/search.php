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
  
// get ID
$section->name = isset($_GET['name']) ? $_GET['name'] : die();

// get section
$section->search();

if($section->inventory!=null){
    // create array
    $section_arr = array(
    'name' => $section->name,
    'inventory' => $section->inventory
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // make JSON
    print_r(json_encode($section_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "Section cannot be found.")
    );
}