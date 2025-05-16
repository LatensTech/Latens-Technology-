<?php
session_start();
include('header.php');
include('config.php');

// Ensure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<p>User not found.</p>";
    exit();
}
?>

<div class="profile-container">
    <h2>Profile Information</h2>
    <p><strong>Username:</strong> <?php echo $user['username']; ?></p>
    <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
    <p><strong>Role:</strong> <?php echo $user['role']; ?></p>

    <?php if ($_SESSION['role'] == 'admin') : ?>
        <!-- Admin-specific actions can be added here -->
        <a href="admin_dashboard.php" class="action-btn">Go to Admin Dashboard</a>
    <?php endif; ?>

    <!-- Option to change password (if needed) -->
    <a href="change_password.php" class="action-btn">Change Password</a>

    <!-- Logout button -->
    <form action="logout.php" method="POST">
        <button type="submit" class="action-btn logout-btn">Logout</button>
    </form>
</div>

<?php include('footer.php'); ?>
