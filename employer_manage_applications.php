<!DOCTYPE html>
<html>

<head>
    <title>Manage Job Applications</title>
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
            <td colspan="6">
                <button style="margin-top:0px ;" type="button" onclick="redirectToEmployer()">
                    Main page</button>
            </td>
        </tr>
        <tr>
            <td colspan="6"><h3>Manage Job Applications</h3></td>
        </tr>

        
        <tr>
            <th>Applicant Name</th>
            <th>Job Title</th>
            <th>Date Applied</th>
            <th>Action</th>
            <th>Application Status</th>
            
        </tr>



         <?php
            @session_start();  
            require_once 'connect_db.php' ;  
            @$companyID = $_SESSION["companyID"];

        $sql = "SELECT A.applicationID, U.name, U.surname, J.job_title, A.application_date, A.application_status
            FROM Applications A
            JOIN Jobs J ON A.jobID = J.jobID
            JOIN Users U ON A.userID = U.userID
            JOIN Companies C ON J.companyID = C.companyID
            WHERE C.companyID = $companyID;";
                $result = sqlsrv_query($conn, $sql);

                if ($result !== false) {

                    while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                        $applicationID = $row['applicationID'];
                        $job_title = $row['job_title'];
                        $u_name = $row['name'];
                        $u_surname = $row['surname'];
                        $application_date = $row['application_date'];
                        $application_status = $row['application_status'];
                        $full_name = "$u_name $u_surname";
                        

                        echo '<tr>';
                        echo '<td><p>' . $full_name . '</p></td>';
                        echo '<td><p>' . $job_title . '</p></td>';
                        echo '<td><p>' . $application_date . '</p></td>';
                        echo '<td>';
                        echo '<a href="approve.php?id=' . $applicationID . '">Approve</a> | ';
                        echo '<a href="reject.php?id=' . $applicationID . '">Reject</a>';
                        echo '</td>';
                        echo '<td><p>' . $application_status . '</p></td>';
                        echo '</tr>';


                    }
                } else {
                    echo '<tr>';
                    echo '<td>No application found.</td>';
                    echo '</tr>';
                }

                sqlsrv_close($conn);
        ?>

    </table>
      </div>
</div>
<script>
    function redirectToEmployer() {
        window.location.href = 'employer.php';
    }
</script>
</body>

</html>