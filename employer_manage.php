<?php
session_start(); 
require_once 'connect_db.php';

include "security.php";
login_guard($_SESSION["companyID"]);

$companyID = $_SESSION["companyID"];

$sql = "SELECT j.jobID, c.company_name, j.job_title, j.job_description, j.listing_status
        FROM Jobs j
        INNER JOIN Companies c ON j.companyID = c.companyID
        WHERE c.companyID = $companyID";
        
$result = sqlsrv_query($conn, $sql);

if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
}

$rows = '';

if (sqlsrv_has_rows($result)) {
    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
        $rows .= '<tr>
                    <td>'.$row["job_title"].'</td>
                    <td>'.$row["company_name"].'</td>
                    <td>'.$row["job_description"].'</td>
					<td>'.$row["listing_status"].'</td>
                    <td><a href="employee_edit_posting.php?id='.$row["jobID"].'">Edit</a></td>
                    <td><a href="employee_delete_posting.php?id='.$row["jobID"].'">Delete</a></td>
                </tr>';
    }
} else {
    $rows = '<tr>
                <td colspan="6">Job posting not found.</td>
            </tr>';
}

sqlsrv_free_stmt($result);
sqlsrv_close($conn);
?><!DOCTYPE html>
<html>

<head>
    <title>Manage Job Postings</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <table>
        <tr>
            <td colspan="6"><button style="margin-top: 0px;" type="button" onclick="redirectToEmployer()">Main page</button></td>
        </tr>
        <tr>
            <th colspan="6">
                <h3>Manage Job Postings</h3>
            </th>
        </tr>
        <tr>
            <th>Job Title</th>
            <th>Company</th>
            <th>Description</th>
			<th>Listing Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php echo $rows; ?>
    </table>

    <script>
        function redirectToEmployer() {
            window.location.href = 'employer.php';
        }
    </script>
</body>

</html>