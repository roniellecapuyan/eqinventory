<?php
include_once('../db.php');

try {
    $data = getPostData();
    $id = $data['id'];
    $name = $data['name'];
    $type = $data['type'];
    $office = $data['office'];
    $active = $data['active'];

    $conn = getConn();
    $sql = "UPDATE employees SET 
                name='$name',
                type='$type', 
                office='$office', 
                active='$active'
                WHERE id='$id'
            ";
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();
    if($result == 1) {
        http_response_code(200);
    } else {
        http_response_code(400);
    }
} 
catch(Exception $error) {
    echo $error;
    http_response_code(400);
}
