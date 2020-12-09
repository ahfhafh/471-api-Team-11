<?php
// headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';
  
// instantiate database
$database = new Database();
$db = $database->connect();
  
// initialize object
$user = new user($db);
  
// get ID
$user->email = isset($_GET['email']) ? $_GET['email'] : die();

// get user
$user->search();

if($user->email!=null){
    // create array
    $user_arr = array(
        'email' => $user->email,
        'Fname' => $user->Fname,
        'Lname' => $user->Lname,
        'phone' => $user->phone
    );
    
    // set response code - 200 OK
    http_response_code(200);
    
    // make JSON
    print_r(json_encode($user_arr));
    
}
  
else{
    //set response code - 404 Not found
    http_response_code(404);
  
    // no products found
    echo json_encode(
        array("message" => "user cannot be found.")
    );
}