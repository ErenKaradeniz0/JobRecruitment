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
    
    $message="You did not choose ";
    if($cityID==0){
        $cont_city=false;   
        $message=$message."a city ";
       } else $cont_city=true;

    if($districtID==0){
        $cont_district=false;
        if(!($cont_city))
            $message=$message."and ";
            $message=$message."district";
    } else $cont_district=true;
    if($cont_city AND $cont_district){
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
    }else{
        echo "<script type='text/javascript'>
                alert('".$message."');
                </script>";
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
        <input type="tel" placeholder="Phone" id="phone" name="phone" minlength="10" maxlength="11" required>

        
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


</body>

</html>

<script>


     function redirectToHome() {
            window.location.href = 'index.php';
        }
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

