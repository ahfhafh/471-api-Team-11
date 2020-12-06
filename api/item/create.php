<?php
    // headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
    Access-Control-Allow-Methods, X-Requested-With");
  
    // include database and object files
    include_once '../config/database.php';
    include_once '../objects/item.php';
  
    // instantiate database
    $database = new Database();
    $db = $database->connect();
  
    // initialize object
    $item = new item($db);

    // get data
    $data = json_decode(file_get_contents("php://input"));

    $item->brand = $data->brand;
    $item->price = $data->price;
    $item->description = $data->description;
    $item->type = $data->type;
    $item->in_stock = $data->in_stock;
    $item->section = $data->section;

    // create post
    if($item->create()) {
        echo json_encode(
            array("message" => "Item created")
        );
    } else {
        echo json_encode(
            array("message" => "Item not created")
        );
    }

?>