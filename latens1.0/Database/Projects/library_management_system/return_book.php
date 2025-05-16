<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$book_id = $_GET['id'];

// Update book status to "available" and clear borrower_id
$sql = "UPDATE books SET status = 'available', borrower_id = NULL WHERE id = $book_id";

if ($conn->query($sql) === TRUE) {
    header("Location: borrow_return.php");
} else {
    echo "Error updating record: " . $conn->error;
}

$conn->close();
?>
