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

    <form>
        <button type="button" onclick="redirectToHome()">Go home page</button>
        <h3>Employer Register</h3>

        <label for="name">Company Name</label>
        <input type="text" placeholder="google" id="name" required>


        <label for="">Email</label>
        <input type="email" placeholder="Email" id="email" required>

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" required>


        <label for="">Phone</label>
        <input type="tel" placeholder="05511375555" id="phone" required>

        <label for="website">Website</label>
        <input type="text" placeholder="google.com" id="website" required>

        <div class="address-container">
            <label for="city">City</label>
            <input type="text" id="city" name="city" placeholder="Adana" required>
            
            <label for="district">District</label>
            <input type="text" id="district" name="district" placeholder="Çukurova" required>
        </div>
        
        <label for="other">Other Address:</label>
        <textarea id="other" name="other" rows="4" cols="30"></textarea>

        <button>Register</button>


    </form>

    <script>
        function redirectToHome() {
            window.location.href = 'index.html';
        }
    </script>
</body>

</html>