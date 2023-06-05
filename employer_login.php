<?php 
    session_start();

    require_once 'connect_db.php'; 
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "SELECT companyID FROM Companies WHERE email = '$email' AND password = '$password'";
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($row) {
            $_SESSION["companyID"] = $row["companyID"];
            header("Location: employer.php");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    }

?>


<!DOCTYPE html>
<html>

<head>
    <title>Employer Login</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>

    <form action="" method ="POST">
        <button type="button" onclick="redirectToHome()">Go home page</button>
        <h3>Employer Login</h3>
    
        <label for="email">Email</label>
        <input type="text" placeholder="Email" id="email" name="email" required>
    
        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>
    
        <button>Log In</button>

        <h4>Don't have an account? <a href="employer_register.php">Sign up</a></h6>
        
    </form>

    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>

    <script>
        function redirectToHome() {
            window.location.href = 'index.php';
        }
    </script>
</body>

</html>