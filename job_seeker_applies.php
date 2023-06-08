<!DOCTYPE html>
<html>
<head>
    <title>Job Postings</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

<div class="table-container">
  <div class="table-scroll">
      <table>
        <tr>
            <td>
                <button type="button" onclick="redirectToJobSeeker()">Go job seeker main page</button>
            </td>
        </tr>
        <tr>
            <td>
                <h3>My Applications</h3>
            </td>
        </tr>

        <?php
        @session_start();
         
        require_once 'connect_db.php';
        @$userID = $_SESSION["userID"];

        include "security.php";
        login_guard($_SESSION["login"]);

$sql = "SELECT j.jobID, j.companyID, j.job_title, j.job_description, j.listing_date, j.working_type, c.company_name, ci.city_name, d.district_name, COALESCE(a.row_count, 0) AS application_count, app.application_status
        FROM Jobs j
        JOIN Companies c ON j.companyID = c.companyID
        LEFT JOIN (
            SELECT jobID, COUNT(*) AS row_count
            FROM Applications
            GROUP BY jobID
        ) a ON j.jobID = a.jobID
        LEFT JOIN Cities ci ON c.cityID = ci.cityID
        LEFT JOIN Districts d ON c.districtID = d.districtID
        LEFT JOIN Applications app ON j.jobID = app.jobID
        WHERE j.listing_status = 'Active' 
        AND j.jobID IN (
            SELECT jobID
            FROM Applications
            WHERE userID = $userID
        )
        AND app.userID = $userID";


        $result = sqlsrv_query($conn, $sql);

        if ($result !== false) {

            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $jobID = $row['jobID'];
                $jobTitle = $row['job_title'];
                $description = $row['job_description'];
                $companyName = $row['company_name'];
                $city_name = $row['city_name'];
                $district_name = $row['district_name'];
                $count= $row['application_count'];
                $application_status =$row['application_status'];


                echo '<tr> <td> <h1>' . $jobTitle . '</h1> <p>Company: ' . $companyName . ' (' . $city_name . '/' . $district_name . ')</p>' . 
                    '<p>Description: ' . $description . '</p>' .
                    '<p>Number of applicants: ' . $count . '</p>' .
                    '<p>Application Status: ' . $application_status . '</p>'. 
                    '<a href="job_seeker_applies_delete.php?id=' . $jobID . '">Delete Application</a>' .
                    '</td></tr>';

            }
        } else {
            echo '<tr>';
            echo '<td>No jobs found.</td>';
            echo '</tr>';
        }

        sqlsrv_close($conn);
        ?>
    </table>
  </div>
</div>
 
    <script>
        function redirectToJobSeeker() {
            window.location.href = 'job_seeker.php';
        }
         function redirectToApplies() {
            window.location.href = 'job_seeker_applies.php';
        }
    </script>
</body>
</html>
