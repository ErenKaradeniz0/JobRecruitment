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
                <h3>Job Postings</h3>
            </td>
        </tr>

        <?php
        @session_start();
         
        require_once 'connect_db.php';
        @$userID = $_SESSION["userID"];


       $sql = "SELECT j.jobID, j.companyID, j.job_title, j.job_description, j.listing_date, j.working_type, c.company_name
        FROM Jobs j
        JOIN Companies c ON j.companyID = c.companyID
        WHERE j.jobID NOT IN (
            SELECT jobID
            FROM Applications
            WHERE userID = $userID
        )";

        $result = sqlsrv_query($conn, $sql);

        if ($result !== false) {

            while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                $jobID = $row['jobID'];
                $jobTitle = $row['job_title'];
                $description = $row['job_description'];
                $companyName = $row['company_name'];


                echo '<tr>';
                echo '<td>';
                echo '<h1>' . $jobTitle . '</h1>';
                echo '<p>Company: ' . $companyName , " ($cityID/$districtID)" . '</p>';
                echo '<p>Description: ' . $description . '</p>';
                echo '<p>Number of applicants: ' . $count . '</p>';
                echo '<a href="job_seeker_apply_server.php?id=' . $jobID . '">Apply Now</a>';
                echo '</td>';
                echo '</tr>';
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
    </script>
</body>
</html>
