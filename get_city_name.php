<?php
require_once 'connect_db.php'; 

if (isset($_GET['cityId'])) {
    $cityId = $_GET['cityId'];
  
    echo json_encode($cityId);
}
?>
