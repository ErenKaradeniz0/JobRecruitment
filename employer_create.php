<!DOCTYPE html>
<html>

<head>
    <title>Create Job Posting</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <form action="employer_process_posting.php" method="POST">
        <button type="button" onclick="redirectToEmployer()">Main page</button>
        <h3>Create Job Posting</h3>

        <label for="job_title">Job Title:</label>
        <input type="text" id="job_title" name="job_title" required>

        <label for="job_description">Job Description:</label>
        <textarea id="job_description" name="job_description" required></textarea>

        <label for="working_type">Working Type:</label>
        <select id="working_type" name="working_type">
            <option value="Remote" style = "color :black;">Remote</option>
            <option value="Hybrid" style = "color :black;">Hybrid</option>
            <option value="On Site" style = "color :black;">On Site</option>
        </select>

        <button>Register</button>

    </form>


</body>
<script>
         function redirectToEmployer() {
            window.location.href = 'employer.php';
        }
</script>
</html>
