<?php
include_once('../db.php');

try {
    $data = getPostData();
    $id = $data['id'];
    $item_type = $data['item_type'];
    $article = $data['article'];
    $description = $data['description'];
    $unit = $data['unit'];
    $requesting_office = $data['requesting_office'];
    $issued_to = $data['issued_to'];
    $status = $data['status'];
    $stock_number = $data['stock_number'];
    $date_acquired = $data['date_acquired'];
    $coa_reports = $data['coa_reports'];
    $unit_value = $data['unit_value'];
    $balance = $data['balance'];
    $onhand = $data['onhand'];
    $remarks = $data['remarks'];

    $conn = getConn();
    $sql = "UPDATE reports SET 
                item_type='$item_type', 
                article='$article', 
                description='$description',
                unit='$unit',
                requesting_office='$requesting_office',
                issued_to='$issued_to',
                status='$status',
                stock_number='$stock_number',
                date_acquired='$date_acquired',
                coa_reports='$coa_reports',
                unit_value='$unit_value',
                balance='$balance',
                onhand='$onhand',
                remarks='$remarks'
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
