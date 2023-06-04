<?php 
    require_once 'connect_db.php'; 
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT userID FROM Users WHERE email = '$username' AND password = '$password'";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }
        
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        if ($row) {
            $_SESSION["userid"] = $row["userID"];
            header("Location: job_seeker.php");
            exit();
        } else {
            $error = "Invalid username or password";
        }
    }



?>


<!DOCTYPE html>
<html>

<head>
    <title>Job Seeker Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

    <form action="" method ="POST">
        <button type="button" onclick="redirectToHome()">Go home page</button>
        <h3>Job Seeker Login</h3>
    
        <label for="username">Username</label>
        <input type="text" placeholder="Email" id="username" name="username" required>
    
        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>
    
        <button>Log In</button>

        <h4>Don't have an account? <a href="job_seeker_register.php">Sign up</a></h6>
        
    </form>

    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>

    <script>
        function redirectToHome() {
            window.location.href = 'index.html';
        }
    </script>
</body>

</html>