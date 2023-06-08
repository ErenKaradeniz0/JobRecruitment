<?php
session_start();
include "security.php";
login_guard($_SESSION["login"]);

login_guard($_SESSION["companyID"]); 

if (isset($_GET['id'])) {
    $jobID = $_GET['id'];
    
    require_once 'connect_db.php';

  $sql = "DELETE FROM Applications WHERE jobID = ?
            DELETE FROM Jobs WHERE jobID = ? ";
    $params = array($jobID, $jobID);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {

        sqlsrv_query($conn, "ROLLBACK TRANSACTION;");
        die(print_r(sqlsrv_errors(), true));
    }

     echo "<script type='text/javascript'>
                    alert('The job posting and associated records have been deleted.');
                    window.location = 'employer_manage.php';
                    </script>"; 
    sqlsrv_close($conn);
} else {
    echo "Invalid job posting ID.";
}
?>