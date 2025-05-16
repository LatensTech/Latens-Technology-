<?php
session_start();
include('header.php');
include('config.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $user_id = $_SESSION['user_id'];

    // Fetch current password from database
    $sql = "SELECT password FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();

    // Check if old password matches
    if (password_verify($old_password, $user['password'])) {
        // Update the password in the database
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE users SET password = '$hashed_password' WHERE id = '$user_id'";

        if ($conn->query($update_sql) === TRUE) {
            echo "<p class='success'>Password updated successfully!</p>";
        } else {
            echo "<p class='error'>Error updating password: " . $conn->error . "</p>";
        }
    } else {
        echo "<p class='error'>Incorrect old password.</p>";
    }
}
?>

<div class="change-password-container">
    <h2>Change Password</h2>
    <form method="POST" action="change_password.php">
        <label for="old_password">Old Password:</label><br>
        <input type="password" name="old_password" required><br>

        <label for="new_password">New Password:</label><br>
        <input type="password" name="new_password" required><br>

        <button type="submit" class="submit-btn">Change Password</button>
    </form>
</div>

<?php include('footer.php'); ?>
