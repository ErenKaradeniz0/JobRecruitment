<?php
require_once 'connect_db.php';
$applicationID = $_GET['id'];

$sql = "UPDATE Applications SET application_status = 'Approved' WHERE applicationID = $applicationID";
$result = sqlsrv_query($conn, $sql);

header("Location: employer_manage_applications.php");
exit();

?>