<?php
session_start();
include "security.php";
login_guard($_SESSION["login"]);

if (isset($_POST['job_title']) && isset($_POST['job_description']) && isset($_POST['working_type'])) {
    $job_title = $_POST['job_title'];
    $job_description = $_POST['job_description'];
    $working_type = $_POST['working_type'];
}

session_start();
require_once 'connect_db.php';
$companyID = $_SESSION["companyID"];
$sql = "SELECT * FROM Companies WHERE companyID = $companyID";

$stmt = sqlsrv_query($conn, $sql);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

$company_info = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if ($company_info) {
    $cityID = $company_info["cityID"];
    $districtID = $company_info["districtID"];


}
$listing_date = date('Y-m-d');
$listing_status = "Active"; 

$sql = "INSERT INTO Jobs (companyID, job_title, job_description, listing_date, listing_status, working_type)
        VALUES ($companyID, '$job_title', '$job_description', '$listing_date', '$listing_status', '$working_type')";

$stmt = sqlsrv_query($conn, $sql);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}
 echo "<script type='text/javascript'>
    alert('Job posting created successfully.');
    window.location = 'employer.php';
    </script>"; 

sqlsrv_close($conn);
?>
