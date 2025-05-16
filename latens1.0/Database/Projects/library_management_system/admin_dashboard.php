<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

include('header.php');  // Include the header to ensure navigation and styles
include('config.php');  // Include database connection

// Handle user deletion
if (isset($_GET['delete_user_id'])) {
    $delete_user_id = $_GET['delete_user_id'];
    $sql = "DELETE FROM users WHERE id = '$delete_user_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>User deleted successfully!</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}

// Fetch all users (except the admin)
$sql = "SELECT * FROM users WHERE role != 'admin'";  // Get users except admin
$result = $conn->query($sql);
?>

<section class="main-content">
    <h2>Welcome, Admin</h2>
    <p>Manage the library system efficiently.</p>

    <div class="add-user-container">
        <h3>Add New User</h3>
        <form method="POST" action="admin_dashboard.php">
            <label for="username">Username:</label><br>
            <input type="text" name="username" id="username" required><br>

            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" required><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" id="password" required><br>

            <label for="role">Role:</label><br>
            <select name="role" id="role" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select><br>

            <button type="submit" class="btn">Add User</button>
        </form>
    </div>

    <div class="user-list-container">
        <h3>Manage Users</h3>
        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<thead><tr><th>Username</th><th>Email</th><th>Role</th><th>Actions</th></tr></thead><tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['username'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . ucfirst($row['role']) . "</td>";
                echo "<td><a href='admin_dashboard.php?delete_user_id=" . $row['id'] . "' class='btn delete-btn' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a></td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>No users found.</p>";
        }
        ?>
    </div>

    <a href="view_books.php" class="btn">Manage Books</a><br> <!-- Link to manage books -->
    <a href="logout.php" class="btn">Logout</a>
</section>

<?php
// Handle form submission to add user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);  // Hash the password
    $role = $_POST['role'];

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', '$role')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>User added successfully!</p>";
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}

include('footer.php');  // Include the footer
?>
