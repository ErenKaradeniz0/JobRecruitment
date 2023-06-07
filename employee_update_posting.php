<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['jobID']) && isset($_POST['jobTitle']) && isset($_POST['jobDescription']) && isset($_POST['listingStatus'])) {
        $jobID = $_POST['jobID'];
        $jobTitle = $_POST['jobTitle'];
        $jobDescription = $_POST['jobDescription'];
		$listingStatus = $_POST['listingStatus'];

        require_once 'connect_db.php';

        $sql = "UPDATE Jobs SET job_title = ?, job_description = ?,listing_status = ? WHERE jobID = ?";
        $params = array($jobTitle, $jobDescription, $listingStatus, $jobID);
        $result = sqlsrv_query($conn, $sql, $params);

        if ($result === false) {
            die(print_r(sqlsrv_errors(), true));
        }

           echo "<script type='text/javascript'>
            alert('Job posting has been updated.');
            window.location = 'employer_manage.php';
            </script>"; 

        sqlsrv_close($conn);
    } else {
        echo "Missing or invalid parameters.";
    }
} else {
    echo "Invalid request.";
}
?>