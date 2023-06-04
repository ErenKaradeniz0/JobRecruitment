<?php
session_start();

if (!isset($_SESSION["email"])) {
    header("Location: job_seeker_login.php"); // Redirect to login page if not logged in
    exit();
}

$cityID = $_SESSION["cityID"];
$districtID = $_SESSION["districtID"];
$name = $_SESSION["name"];
$surname = $_SESSION["surname"];
$password = $_SESSION["password"];
$email = $_SESSION["email"];
$phone = $_SESSION["phone"];
$address = $_SESSION["address"];
$birth_date = $_SESSION["birth_date"];
$gender = $_SESSION["gender"];
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
        <h3>Welcome, <?php echo $name; ?></h3>
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
