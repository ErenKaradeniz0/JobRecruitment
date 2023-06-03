<?php
require_once 'connect_db.php'; // Assuming you have a file to establish the database connection

if (isset($_GET['cityId'])) {
    $cityId = $_GET['cityId'];

    $sql = "SELECT * FROM Districts WHERE cityID = ?";
    $params = array($cityId);
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $districts = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $districts[] = array(
            'districtID' => $row['districtID'],
            'district_name' => $row['district_name']
        );
    }

    echo json_encode($districts);
}
?>
