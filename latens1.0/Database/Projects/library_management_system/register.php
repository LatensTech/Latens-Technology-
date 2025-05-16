<?php 
include('config.php');

// Handle form submission for user registration
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email']; // Capture email
    $role = $_POST['role'];

    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, password, email, role) VALUES ('$username', '$hashed_password', '$email', '$role')";

    if ($conn->query($sql) === TRUE) {
        $message = "<p class='success'>User registered successfully!</p>";
    } else {
        $message = "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
?>

<?php include('header.php'); ?>

<section class="main-content">
    <div class="form-container">
        <h2>Register User</h2>
        <?php if (isset($message)) echo $message; ?>
        <form method="POST" action="register.php">
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" required><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" required><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required><br>

            <label for="role">Role:</label><br>
            <select name="role" id="role">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select><br>

            <button type="submit">Register</button>
        </form>
    </div>
</section>

<?php include('footer.php'); ?>
