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


        <button type="button" onclick="redirectToHome()">Log out</button>
        

    </form>

    <script>
        function redirectToCreate() {
            window.location.href = 'employercreate.html';
        }
        function redirectToManage() {
            window.location.href = 'employermanage.html';
        }

        function redirectToManageApplications() {
                window.location.href = 'employermanageapplications.html';
            }

        function redirectToHome() {
                window.location.href = 'index.html';
            }
    </script>

</body>

</html>