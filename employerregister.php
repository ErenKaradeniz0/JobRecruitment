<?php 

require_once 'connect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $website=$_POST['website'];
    $city=$_POST['city'];
    $district=$_POST['district'];
    @$address=$_POST['other_address'];
    
    $sql = "SELECT * FROM Companies WHERE email = '$email'";
    $stmt = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if($row)
    {
        echo "This email is already exist.";
    }
    else
    {
        $reg = "INSERT INTO Companies (cityID,districtID,company_name,password,email,phone,address,website)
                        VALUES ($city,$district,'$name','$password','$email','$phone','$address','$website')";
        if(sqlsrv_query($conn,$reg)){
            header("Location: employer.php");
        }
        else
            echo "ERROR";
        
    }

    
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>Employer Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form method="POST">
        <button type="button" onclick="redirectToHome()">Go home page</button>
        <h3>Employer Register</h3>

        <label for="name">Company Name</label>
        <input type="text" placeholder="google" id="name" name="name" required>


        <label for="">Email</label>
        <input type="email" placeholder="Email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>


        <label for="">Phone</label>
        <input type="tel" placeholder="05511375555" id="phone" name="phone" required>

        <label for="website">Website</label>
        <input type="text" placeholder="google.com" id="website" name="website" required>

        <div class="address-container">
            <label for="city">City</label>
            <input type="text" id="city" name="city" placeholder="Adana" name="city" required>
            
            <label for="district">District</label>
            <input type="text" id="district" name="district" placeholder="Çukurova" name="district" required>
        </div>
        
        <label for="other">Other Address:</label>
        <textarea id="other" name="other_address" rows="4" cols="30"></textarea>

        <button>Register</button>


    </form>

    <script>
        function redirectToHome() {
            window.location.href = 'index.html';
        }
    </script>
</body>

</html>