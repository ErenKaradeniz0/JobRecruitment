<?php 
    session_start();

    require_once 'connect_db.php'; 

    include "security.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $safe_password=password_chain($password);

        $sql = "SELECT userID FROM Users WHERE email = '$email' AND password = '$safe_password'";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($row) {
            $_SESSION["userID"] = $row["userID"];
            $_SESSION["login"]=true;
            header("Location: job_seeker.php");
            exit();
        } else {
            $error = "Invalid email or password";
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
    
        <label for="email">Email</label>
        <input type="text" placeholder="Email" id="email" name="email" required>
    
        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>
    
        <button>Log In</button>

        <h4>Don't have an account? <a href="job_seeker_register.php">Sign up</a></h6>
        
    </form>

    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>

    <script>
        function redirectToHome() {
            window.location.href = 'index.php';
        }
    </script>
</body>

</html>

