<?php 
    @session_start();  
    require_once 'connect_db.php' ;  
    @$userID = $_SESSION["userID"];

    $sql = "SELECT * FROM Users WHERE userID = $userID";
    
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $user_info=sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if($user_info){
        $u_name = $user_info["name"];
        $u_surname = $user_info["surname"];
        $u_password = $user_info["password"];
        $u_email = $user_info["email"];
        $u_phone= $user_info["phone"];
        $u_address = $user_info["address"];
        $u_birth_date =$user_info["birth_date"];
        
        $u_gender = $user_info["gender"];
        if($u_gender=="Male"){
            $male="checked";
        }
        elseif($u_gender=="Male"){
            $female="checked";
        }

    }


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
        <input type="text" value="<?php echo $u_name;?>" id="name" name="name" required>
    
        <label for="surname">Surname</label>
        <input type="text" value="<?php echo $u_surname;?>" id="surname" name="surname" required>
    </div>
    
    <label for="">Email</label>
    <input type="email" value="<?php echo $u_email;?>" id="email" name="email" required>
    
    <label for="password">Password</label>
    <input type="password" value="<?php echo $u_password;?>" id="password" name="password" required>
    
    
    <div class="gender-container">
        <label for="gender"> Gender : </label>
        <input type="radio" id="gender-male" name="gender" value="Male" ng-model='genderValue' <?php echo @$male;?>>
        <label for="gender-male">Male</label>
        <input type="radio" id="gender-female" name="gender" value="Female" <?php echo @$female;?>>
        <label for="gender-female">Female</label>
    </div>
    
    <label for="">Phone</label>
    <input type="tel" value="<?php echo $u_phone;?>" id="phone" name="phone" required>
    
    <label for="">Birth Date</label>
    <input type="date" value="<?php echo $u_birth_date; ?>" id="birth_date" name="birth_date" required>
    
    <div class="address-container">
        <label for="city">City</label>
        <select name="city" id="city">
                    <option selected=" selected" value="0" style="color:black;">Select to City</option>
            <?php include "get_cities.php";?>
        </select>
    
    
        <label for="district">District</label>
        <select name="district" id="district">
            <option selected="selected" value="0" style="color:black;">Select to District</option>
        </select>
    </div>
    
    <label for="other">Other Address:</label>
    <textarea id="other" name="other_address" rows="4" cols="30"><?php echo $u_address;?></textarea>
    
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