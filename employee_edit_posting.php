<?php
if (isset($_GET['id'])) {
    $jobID = $_GET['id'];

    require_once 'connect_db.php';

    $sql = "SELECT * FROM Jobs WHERE jobID = ?";
    $params = array($jobID);
    $result = sqlsrv_query($conn, $sql, $params);

    if ($result === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    if (sqlsrv_has_rows($result)) {
        $row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC);
        $jobTitle = $row['job_title'];
        $jobDescription = $row['job_description'];
		$listingStatus = $row['listing_status'];

        echo '
                <form method="post" action="employee_update_posting.php">
                    <h3>Edit Job Posting</h3>
                    <input type="hidden" name="jobID" value="'.$jobID.'">
                    <label>Job Title:</label>
                    <input type="text" name="jobTitle" value="'.$jobTitle.'"><br>
                    <label>Job Description:</label>
                    <input type="text" name="jobDescription" value="'.$jobDescription.'"><br>
                    <label>Listing Status:</label>
                    <select name="listingStatus">
                        <option style="color:black;" value="Active" '.($listingStatus == "Active" ? ' selected' : '').'>Active</option>
                        <option style="color:black;"     value="Passive"'.($listingStatus == "Passive" ? ' selected' : '').'>Passive</option>
                    </select><br>
                    <input type="submit" value="Save">
                </form>';
    } else {
        echo "Job posting not found.";
    }

    sqlsrv_free_stmt($result);
    sqlsrv_close($conn);
} else {
    echo "Invalid job posting ID.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Job Postings</title>
    <link rel="stylesheet" href="style.css">
</head>