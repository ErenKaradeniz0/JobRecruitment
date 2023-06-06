<!DOCTYPE html>
<html>
<head>
    <title>Job Postings</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
        <tr>
            <td>
    <input  id="search_input" type="text" placeholder="Search.." name="search">
     <button id="search_button" type="submit"><i class="fa fa-search"></i></button>
            </td>
        </tr>
        </tr>

        <?php
        @session_start();
         
        require_once 'connect_db.php';
        @$userID = $_SESSION["userID"];


$sql = "SELECT j.jobID, j.companyID, j.job_title, j.job_description, j.listing_date, j.working_type, c.company_name, ci.city_name, d.district_name, COALESCE(a.row_count, 0)     AS application_count
        FROM Jobs j
        JOIN Companies c ON j.companyID = c.companyID
        LEFT JOIN (
            SELECT jobID, COUNT(*) AS row_count
            FROM Applications
            GROUP BY jobID
        ) a ON j.jobID = a.jobID
        LEFT JOIN Cities ci ON c.cityID = ci.cityID
        LEFT JOIN Districts d ON c.districtID = d.districtID
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
                $city_name = $row['city_name'];
                $district_name = $row['district_name'];
                $count= $row['application_count'];


                echo '<tr>';
                echo '<td>';
                echo '<h1>' . $jobTitle . '</h1>';
                echo '<p>Company: ' . $companyName , " ($city_name/$district_name)" . '</p>';
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

                <tr>
            <td>
                <button type="button" onclick="redirectToApplies()">My Applications</button>
            </td>
        </tr>
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
