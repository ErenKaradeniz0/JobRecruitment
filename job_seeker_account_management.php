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
    <title>Account Management</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
 

    <form>
        <h3>Account Management</h3>
    <div class="name-container">
        <label for="name">Name</label>
        <input type="text" placeholder="Eren" id="name" name="name" value="<?php echo $name; ?>" required>
    
        <label for="surname">Surname</label>
        <input type="text" placeholder="Karadeniz" id="surname" name="surname" value="<?php echo $surname; ?>" required>
    </div>
    
    <label for="">Email</label>
    <input type="email" placeholder="Email" id="email" name="email" value="<?php echo $email; ?>" required>
    
    <label for="password">Password</label>
    <input type="password" placeholder="Password" id="password" name="password" value="<?php echo $password; ?>" required>
    
    
    <div class="gender-container">
        <label for="gender"> Gender : </label>
        <input type="radio" id="gender-male" name="gender" value="male">
        <label for="gender-male">Male</label>
        <input type="radio" id="gender-female" name="gender" value="female">
        <label for="gender-female">Female</label>
    </div>
    
    <label for="">Phone</label>
    <input type="tel" placeholder="05511375555" id="phone" name="phone" value="<?php echo $phone; ?>" required>
    
    <label for="">Birth Date</label>
    <input type="date" placeholder="11/11/2002" id="birth_date" name="birth_date" value="<?php echo $birth_date; ?>" required>
    
    <div class="address-container">
        <label for="city">City</label>
        <select name="city" id="city">
                    <option selected="selected" value="<?php echo $cityID; ?>" style="color:black;">Select to City</option>
            <?php include "get_cities.php";?>
        </select>
    
    
        <label for="district">District</label>
        <select name="district" id="district">
            <option selected="selected" value="<?php echo $districtID; ?>" style="color:black;">Select to District</option>
        </select>
    </div>
    
    <label for="other">Other Address:</label>
    <textarea id="other" name="other_address" rows="4" cols="30"><?php echo $address; ?></textarea>
    
    <button>Save</button>
    <button type="button" onclick="redirectToJobSeeker()">Main page</button>
    <button style="background-color:red; color:white">Delete Account</button>
    
    
    </form>


<script>
    var citySelect = document.getElementById("city");
    var districtSelect = document.getElementById("district");


    citySelect.addEventListener("change", function () {

        var cityId = citySelect.value;

        districtSelect.innerHTML = "";

        var xhr = new XMLHttpRequest();
        xhr.open("GET", "get_districts.php?cityId=" + cityId, true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var districts = JSON.parse(xhr.responseText);
                districts.forEach(function (district) {
                    var option = document.createElement("option");
                    option.value = district.districtID;
                    option.text = district.district_name;
                    option.style.color = "#000000";
                    districtSelect.appendChild(option);
                });
            }
        };
        xhr.send();
    });    


        
    function redirectToJobSeeker() {
        window.location.href = 'job_seeker.php';
    }
</script>
</body>

</html>