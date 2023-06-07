<?php 
    @session_start();  
    require_once 'connect_db.php' ;  
    @$companyID = $_SESSION["companyID"];

    $sql = "SELECT c.companyID, c.cityID, c.districtID, c.company_name, c.website, c.email, c.password, c.phone, c.address, t.city_name, d.district_name
            FROM Companies c 
            JOIN Cities t ON c.cityID = t.cityID 
            JOIN Districts d ON c.districtID = d.districtID WHERE c.companyID = $companyID";
    
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $company_info=sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if($company_info){
        $c_company_name = $company_info["company_name"];
        $c_website = $company_info["website"];
        $c_email = $company_info["email"];
        $c_password = $company_info["password"];
        $c_phone= $company_info["phone"];
        $c_address = $company_info["address"];
        
        $c_city_id=$company_info["cityID"];
        $t_city_name=$company_info["city_name"];
        $c_district_id=$company_info["districtID"];
        $d_district_name=$company_info["district_name"];

        $_SESSION["cityID"]=$company_info["cityID"];
        $_SESSION["districtID"]=$company_info["districtID"];
    }

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['Update'])){

            $up_company_name = $_POST['company_name'];
            $up_website = $_POST['website'];
            $up_email = $_POST['email'];
            $up_password = $_POST['password'];
            $up_phone = $_POST['phone'];
            $up_cityId=$_POST['city'];
            $up_districtId=$_POST['district'];
            @$up_address=$_POST['other_address'];

            
            $sql = "UPDATE Companies SET company_name='$up_company_name', website='$up_website', email='$up_email',password='$up_password',
                    phone='$up_phone', cityID=$up_cityId, districtID=$up_districtId  
                    WHERE companyID=$companyID";
        
            $stmt = sqlsrv_query($conn, $sql);
            if ($stmt === false) {
                die(print_r(sqlsrv_errors(), true));
            }
            else{
                echo "<script type='text/javascript'>
                    alert('Your information has been successfully updated.');
                    window.location = 'employer.php';
                    </script>"; 
            }
            
        }
    }

        if (isset($_POST["Delete"])) {
                    $query = "DELETE A
                    FROM Applications A
                    JOIN Jobs J ON A.jobID = J.jobID
                    JOIN Companies C ON J.companyID = C.companyID
                    WHERE C.companyID = $companyID;

                    DELETE J
                    FROM Jobs J
                    JOIN Companies C ON J.companyID = C.companyID
                    WHERE C.companyID = $companyID;

                    DELETE
                    FROM Companies
                    WHERE companyID = $companyID;
                    ";
                    $result = sqlsrv_query($conn, $query);

                    if ($result === false) {
                        $errors = sqlsrv_errors();
                        foreach ($errors as $error) {
                            echo "Query 1 Error: " . $error['message'] . "<br>";
                        }
                    }
                    if ($result) {
                        $message = "Deletion completed successfully.";
                        header("Location: index.php?message=" . urlencode($message));
                        exit();
                    } else {
                            echo "<script type='text/javascript'>
                    alert('Deletion failed');
                    window.location = 'employer_account_management.php';
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

    <form action="" method ="POST">
        <h3>Account Management</h3>

        <label for="company_name">Company Name</label>
        <input type="text" value="<?php echo $c_company_name;?>" placeholder="Google" id="company_name" name="company_name" required>

        <label for="surname">Website</label>
        <input type="text" value="<?php echo $c_website;?>" placeholder="google.com" id="website" name="website" required>
       
        <label for="">Email</label>
        <input type="email" value="<?php echo $c_email;?>" placeholder="Email" id="email" name="email" required>

        <label for="password">Password</label>
        <input type="password" value="<?php echo $c_password;?>" placeholder="Password" id="password" name="password" required>

        <label for="">Phone</label>
        <input type="tel" value="<?php echo $c_phone;?>" placeholder="05511375555" id="phone" name="phone" required>
        
        <div class="address-container">
            <label for="city">City</label>
            <select name="city" id="city">
                <?php include "get_cities2.php";?>
                <?php include "get_cities.php";?>
            </select>
            

            <label for="district">District</label>
            <select name="district" id="district">
                 <?php include "get_districts2.php";?>
            </select>
        </div>

        <label for="address">Other Address:</label>
        <textarea id="address" name="address" rows="4" cols="30"><?php echo $c_address;?></textarea>

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
        window.location.href = 'employer.php';
        
    }
</script>
  
</body>

</html>
