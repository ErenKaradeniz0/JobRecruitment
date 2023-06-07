<?php 
    @session_start();  
    require_once 'connect_db.php' ;  
    @$userID = $_SESSION["userID"];

    include "security.php";
    login_guard($_SESSION["userID"]);


    $sql = "SELECT u.userID, u.cityID, u.districtID, u.name, u.surname, u.password, u.email,
            u.phone, u.address, u.birth_date,u.gender, c.city_name, d.district_name
            FROM Users u 
            JOIN Cities c ON u.cityID = c.cityID 
            JOIN Districts d ON u.districtID = d.districtID WHERE u.userID = $userID";
    
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
        elseif($u_gender=="Female"){
            $female="checked";
        }
        
        $u_city_id=$user_info["cityID"];
        $c_city_name=$user_info["city_name"];
        $u_district_id=$user_info["districtID"];
        $d_district_name=$user_info["district_name"];

        $_SESSION["cityID"]=$user_info["cityID"];
        $_SESSION["districtID"]=$user_info["districtID"];
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['Update'])){

            $up_name = $_POST['name'];
            $up_surname = $_POST['surname'];
            $up_email = $_POST['email'];
            $up_password = $_POST['password'];
            @$up_gender = $_POST['gender'];
            $up_phone = $_POST['phone'];
            $up_birth_date=$_POST['birth_date'];
            $up_cityId=$_POST['city'];
            $up_districtId=$_POST['district'];
            @$up_address=$_POST['address'];

            $safe_password=password_chain($up_password);

            
            $sql = "UPDATE Users SET name='$up_name', surname='$up_surname', email='$up_email',password='$safe_password', 
                    gender='$up_gender', phone='$up_phone', birth_date='$up_birth_date', cityID=$up_cityId, districtID=$up_districtId  
                    WHERE userID=$userID";
        
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            else{
                echo "<script type='text/javascript'>
                    alert('Your information has been successfully updated.');
                    window.location = 'job_seeker.php';
                    </script>"; 
            }
            
        }
    }

        if (isset($_POST["Delete"])) {
    $query = "DELETE FROM Applications WHERE userID = $userID; 
              DELETE FROM Users WHERE userID = $userID;";
    $result = sqlsrv_query($conn, $query);
    
    if ($result === false) {
        $errors = sqlsrv_errors();
        foreach ($errors as $error) {
            echo "Query Error: " . $error['message'] . "<br>";
        }
    }
    if ($result) {
        $message = "Deletion completed successfully.";
        header("Location: index.php?message=" . urlencode($message));
        exit();
    } else {
        echo "<script type='text/javascript'>
            alert('Deletion failed');
            window.location = 'job_seeker_account_management.php';
            </script>"; 
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
 

    <form action="" method="POST">
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
        <input type="radio" id="gender-male" name="gender" value="Male" ng-model='genderValue' <?php echo @$male;?> required>
        <label for="gender-male">Male</label>
        <input type="radio" id="gender-female" name="gender" value="Female" <?php echo @$female;?> required>
        <label for="gender-female">Female</label>
    </div>
    
    <label for="">Phone</label>
    <input type="text" value="<?php echo $u_phone;?>" pattern="[0-9]{}" id="phone" name="phone"  maxlength="11" required>
    
    <label for="">Birth Date</label>
    <input type="date" value="<?php echo $u_birth_date; ?>" id="birth_date" name="birth_date" required>
    
    <div class="address-container">
        <label for="city">City</label>
        <select name="city" id="city">
            
            <?php include "get_cities2.php";?>
        </select>
    
    
        <label for="district">District</label>
        <select name="district" id="district">
            <?php include "get_districts2.php";?>
        </select>
    </div>
    
    <label for="address">Address:</label>
    <input name="address" placeholder="Address" value = "<?php echo $u_address;?>" required></input>
    
    
    <button type="submit" name="Update">Save</button>
    <button type="button" onclick="redirectToJobSeeker()">Main page</button>
    <button type="submit"style="background-color:red; color:white" name="Delete">Delete Account</button>
    
    
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