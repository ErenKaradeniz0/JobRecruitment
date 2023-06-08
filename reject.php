<?php
include "security.php";
login_guard($_SESSION["login"]);
require_once 'connect_db.php';
$applicationID = $_GET['id'];

$sql = "UPDATE Applications SET application_status = 'Rejected' WHERE applicationID = $applicationID";
$result = sqlsrv_query($conn, $sql);

header("Location: employer_manage_applications.php");
exit();

?>