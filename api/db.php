<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");

function getConn() {
    $dbHost = "localhost";
    $dbName = "eims_crud";
    $dbUsername = "root";
    $dbPassword = "";
    $connString = "mysql:host=$dbHost;dbname=$dbName";
    try {
        $conn = new PDO($connString, $dbUsername, $dbPassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(Exception $e) {
        return null;
    }
}

function getPostData() {
    $requestBody = file_get_contents('php://input');
    $requestData = json_decode($requestBody, true); 

    if(count($requestData) < 1) {
        throw "error";
    }
    return $requestData;
}