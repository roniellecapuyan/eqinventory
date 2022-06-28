<?php
include_once('../db.php');

try {
    $data = getPostData();
    $id = $data['id'];

    $conn = getConn();
    $sql = "DELETE FROM items WHERE id='$id'";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    if($result == 1) {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
} 
catch(Exception $exception) {
    echo $error;
    http_response_code(400);
}