<?php
@session_start();

include "security.php";
login_guard($_SESSION["userID"]);

if (!isset($_SESSION['userID'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "Invalid job ID.";
    exit();
}

require_once 'connect_db.php';

$userID = $_SESSION['userID'];
$jobID = $_GET['id'];

$sql = "DELETE FROM Applications WHERE userID = $userID AND jobID = $jobID";
$result = sqlsrv_query($conn, $sql);

if ($result !== false) {

    header("Location: job_seeker_applies.php");
    exit();
} else {

    echo "Failed to delete the application.";
}

sqlsrv_close($conn);
?>
