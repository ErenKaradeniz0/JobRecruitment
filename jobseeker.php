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
        <button type="button" onclick="redirectApply()">Apply</button>
        <button type="button" onclick="redirectToHome()">Go home page</button>
    </form>

    <script>
        function redirectApply() {
            window.location.href = 'jobseekerapply.php';
        }

        function redirectToHome() {
            window.location.href = 'index.php';
        }
    </script>

</body>

</html>
