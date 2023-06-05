<?php
    @session_start();  
    require_once 'connect_db.php' ;  
   
if (isset($_GET['id'])) {
    $jobID = $_GET['id'];

    @$userID = $_SESSION["userID"];

    $applicationDate = date('Y-m-d H:i:s');

    $applicationStatus = 'Pending';


    $sql = "INSERT INTO applications (jobID, userID, application_date, application_status)
            VALUES ('$jobID', '$userID', '$applicationDate', '$applicationStatus')";
    $result = sqlsrv_query($conn, $sql);

    if ($result !== false) {

          echo "<script type='text/javascript'>
                    alert('Application submitted successfully.');
                    window.location = 'job_seeker_apply.php';
                    </script>";
        echo '<p>Application submitted successfully.</p>';
    } else {
        echo '<p>Error submitting the application:</p>';
        echo '<p>' . sqlsrv_errors()[0]['message'] . '</p>';
    }

} else {
    echo '<p>Invalid job ID.</p>';
}

sqlsrv_close($conn);
?>
