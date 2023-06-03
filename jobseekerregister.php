<?php 

require_once 'connect_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    @$gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $birthdate=$_POST['birthdate'];
    $city=$_POST['city'];
    $district=$_POST['district'];
    @$address=$_POST['other_address'];
    
    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $stmt = sqlsrv_query($conn, $sql);
    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if($row)
    {
        echo "This email is already exist.";
    }
    else
    {
        $reg = "INSERT INTO Users (cityID,districtID,name,surname,password,email,phone,address,birth_date,gender)
                        VALUES ($city,$district,'$name','$surname','$password','$email','$phone','$address','$birthdate','$gender')";
        if(sqlsrv_query($conn,$reg)){
            header("Location: jobseeker.php");
        }
        else
            echo "ERROR";
        
    }

    
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Job Seeker Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form action="" method ="POST">
        <button type="button" onclick="redirectToHome()">Go home page</button>
        <h3>Job Seeker Register</h3>

        <div class="name-container">
            <label for="name">Name</label>
            <input type="text" placeholder="Eren" id="name" name="name" required>

            <label for="surname">Surname</label>
            <input type="text" placeholder="Karadeniz" id="surname" name="surname" required>
        </div>




        <label for="">Email</label>
        <input type="email" placeholder="Email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required>


        <div class="gender-container">
            <label for="gender"> Gender : </label>
            <input type="radio" id="gender-male" name="gender" value="male">
            <label for="gender-male">Male</label>
            <input type="radio" id="gender-female" name="gender" value="female">
            <label for="gender-female">Female</label>
        </div>

        <label for="">Phone</label>
        <input type="tel" placeholder="05511375555" id="phone" name="phone" required>

        <label for="">Birth Date</label>
        <input type="date" placeholder="11/11/2002" id="birth_date" name="birthdate" required>

        <div class="address-container">
            <label for="city">City</label>
            <select name="city" id="city""> <!-- fontblack-->
                <option selected="selected" value="0" style="color:black;">Select to City</option> <!-- fontblack-->
                <?php include "get_cities.php";?>
            </select>
            

            <label for="district">District</label>
            <select name="district" id="district"> <!-- fontblack-->
                <option selected="selected" value="0" style="color:black;">Select to District</option> <!-- fontblack-->
                <!-- District options will be populated dynamically using JavaScript -->
            </select>
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

<script>
    var citySelect = document.getElementById("city");
    var districtSelect = document.getElementById("district");

    // Event listener for the city select change
    citySelect.addEventListener("change", function() {
        
        var cityId = citySelect.value;
        // Clear existing options
        districtSelect.innerHTML = "";

        // AJAX request to fetch districts based on the selected city
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_districts.php?cityId=" + cityId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var districts = JSON.parse(xhr.responseText);
                districts.forEach(function(district) {
                    var option = document.createElement("option");
                    option.value = district.districtID;
                    option.text = district.district_name;
                    option.style.color="#000000"; //fontblack
                    districtSelect.appendChild(option);
                });
            }
        };
        xhr.send();
    });    
</script>

