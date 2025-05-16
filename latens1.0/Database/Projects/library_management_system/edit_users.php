<?php
session_start();
include('config.php');

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    // Fetch the user's details
    $sql = "SELECT * FROM users WHERE id = '$user_id'";
    $result = $conn->query($sql);
    $user = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Update the user's details
    $update_sql = "UPDATE users SET name = '$name', email = '$email' WHERE id = '$user_id'";
    
    if ($conn->query($update_sql)) {
        header("Location: manage_users.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<form action="edit_user.php?id=<?php echo $user_id; ?>" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>" required>

    <button type="submit">Update</button>
</form>
