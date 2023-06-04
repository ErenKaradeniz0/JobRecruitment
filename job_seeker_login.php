<?php
session_start();

require_once 'connect_db.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID'];
    $cityID = $_POST['cityID'];
    $districtID = $_POST['districtID'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];

    $sql = "SELECT userID, cityID, districtID, name, surname, password, email, phone, address, birth_date, gender FROM Users WHERE email = '$email' AND password = '$password'";
    $stmt = sqlsrv_query($conn, $sql);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if ($row) {
        $_SESSION["userID"] = $row["userID"];
        $_SESSION["cityID"] = $row["cityID"];
        $_SESSION["districtID"] = $row["districtID"];
        $_SESSION["name"] = $row["name"];
        $_SESSION["surname"] = $row["surname"];
        $_SESSION["password"] = $row["password"];
        $_SESSION["email"] = $row["email"];
        $_SESSION["phone"] = $row["phone"];
        $_SESSION["address"] = $row["address"];
        $_SESSION["birth_date"] = $row["birth_date"];
        $_SESSION["gender"] = $row["birth_date"];
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
    
        <label for="email">email</label>
        <input type="text" placeholder="Email" id="email" name="email" required>
    
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