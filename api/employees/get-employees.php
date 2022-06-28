<?php

include_once('../db.php');

try {
    $conn = getConn();

    $sql = "SELECT * FROM employees ORDER BY name";
    
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