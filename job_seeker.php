<?php 
    session_start(); 

    require_once 'connect_db.php' ; 
    
    $userID = $_SESSION["userID"];

    $sql = "SELECT name FROM Users WHERE userID = $userID";
    
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $user_info = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if($user_info){
        $u_name = $user_info["name"];
    }


?> 

<!DOCTYPE html>
<html>

<head>
  
    <title>User Selection</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form>
        <h3>Welcome, <?php echo $u_name;?> </h3>
        <h3>Select your Choice</h3>
        <button type="button" onclick="redirectManage()">Manage Account</button>
        <button type="button" onclick="redirectApply()">Apply</button>
        <button type="button" onclick="redirectToHome()">Log out</button>
    </form>

    <script>
        function redirectManage() {
            window.location.href = 'job_seeker_account_management.php';
        }
        function redirectApply() {
            window.location.href = 'job_seeker_apply.php';
        }

        function redirectToHome() {
            window.location.href = 'index.html';
        }
    </script>

</body>

</html>
