<?php 

require_once 'connect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cityID=$_POST['city'];
    $districtID=$_POST['district'];
    $company_name = $_POST['company_name'];
    $website = $_POST['website'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    @$address=$_POST['address'];
    
    $sql = "SELECT * FROM Companies WHERE email = '$email'";
    $stmt = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if($row)
    {
        echo "This email is already exist.";
    }
    else
    {
        $reg = "INSERT INTO Companies (cityID,districtID,company_name,website,email,password,phone,address)
                        VALUES ($cityID,$districtID,'$company_name','$website','$email','$password','$phone','$address')";
        if(sqlsrv_query($conn,$reg)){
            header("Location: employer_login.php");
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

    <form action="" method ="POST">
        <button type="button" onclick="redirectToHome()">Go home page</button>
        <h3>Employer Register</h3>

        <label for="company_name">Company Name</label>
        <input type="text" placeholder="Google" id="company_name" name="company_name" required>

        <label for="surname">Website</label>
        <input type="text" placeholder="google.com" id="website" name="website" required>
       
        <label for="">Email</label>
        <input type="email" placeholder="Email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>

        <label for="">Phone</label>
        <input type="tel" placeholder="05511375555" id="phone" name="phone" required>
        
        <div class="address-container">
            <label for="city">City</label>
            <select name="city" id="city">
                <option selected="selected" value="0" style="color:black;">Select to City</option>
                <?php include "get_cities.php";?>
            </select>
            

            <label for="district">District</label>
            <select name="district" id="district">
                <option selected="selected" value="0" style="color:black;">Select to District</option>
                
            </select>
        </div>

        <label for="address">Other Address:</label>
        <textarea id="address" name="address" rows="4" cols="30"></textarea>

        <button>Register</button>


    </form>

    <script>
        function redirectToHome() {
            window.location.href = 'index.html';
        }
    </script>
</body>

</html>

<script>
    var citySelect = document.getElementById("city");
    var districtSelect = document.getElementById("district");

    citySelect.addEventListener("change", function() {
        
        var cityId = citySelect.value;
      
        districtSelect.innerHTML = "";

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_districts.php?cityId=" + cityId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var districts = JSON.parse(xhr.responseText);
                districts.forEach(function(district) {
                    var option = document.createElement("option");
                    option.value = district.districtID;
                    option.text = district.district_name;
                    option.style.color="#000000";
                    districtSelect.appendChild(option);
                });
            }
        };
        xhr.send();
    });    
</script>

