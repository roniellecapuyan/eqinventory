<?php

include_once('../db.php');

try {
    $conn = getConn();

    $search = $_GET['search'];
    
    $sql = "SELECT * FROM users WHERE
        username like '%$search%' OR
        name like '%$search%'
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();

    echo json_encode($result);
    http_response_code(200);
}
catch(Exception $error) {
    echo $error;
    http_response_code(400);
}