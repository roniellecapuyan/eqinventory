<?php
include_once('../db.php');

try {
    $data = getPostData();
    $id = $data['id'];
    $username = $data['username'];
    $password = $data['password'];
    $name = $data['name'];

    $conn = getConn();
    $sql = "UPDATE users SET 
                username='$username', 
                password='$password', 
                name='$name'
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
