<?php
session_start();
include('config.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

$sql = "SELECT id, name, email, role FROM users";
$result = $conn->query($sql);

echo "<div class='table-container'><h2>Manage Users</h2>";
if ($result->num_rows > 0) {
    echo "<table>";
    echo "<thead><tr><th>Name</th><th>Email</th><th>Role</th><th>Actions</th></tr></thead>";
    echo "<tbody>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['name'] . "</td><td>" . $row['email'] . "</td><td>" . $row['role'] . "</td>";
        echo "<td><a href='edit_user.php?id=" . $row['id'] . "' class='edit-btn'>Edit</a> | 
                    <a href='delete_user.php?id=" . $row['id'] . "' class='delete-btn'>Delete</a></td></tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No users found.</p>";
}

echo "</div>";
?>
