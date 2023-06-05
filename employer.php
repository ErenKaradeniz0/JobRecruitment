<?php 
    session_start(); 

    require_once 'connect_db.php' ; 
    
    $companyID = $_SESSION["companyID"];

    $sql = "SELECT company_name FROM Companies WHERE companyID = $companyID";
    
    $stmt = sqlsrv_query($conn, $sql);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    $company_info = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if($company_info){
        $c_name = $company_info["company_name"];
    }


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
    
        
        <h3>Select your Choice</h3>

        <button type="button" onclick="redirectToCreate()">
            Create a job advertisement
        </button>

        <button type="button" onclick="redirectToManage()">
            Manage job advertisements
        </button>

        <button type="button" onclick="redirectToManageApplications()">
            Manage applications
        </button>
         
        <button type="button" onclick="redirectToManageAccount()">
            Manage account
        </button>

        <button type="button" onclick="redirectToHome()">Log out</button>
        

    </form>

    <script>
        function redirectToCreate() {
            window.location.href = 'employer_create.html';
        }
        function redirectToManage() {
            window.location.href = 'employer_manage.html';
        }

        function redirectToManageApplications() {
                window.location.href = 'employer_manage_applications.html';
            }

         function redirectToManageAccount() {
            window.location.href = 'employer_account_management.php';
        }

        function redirectToHome() {
                window.location.href = 'index.php';
            }

       
        
    </script>

</body>

</html>