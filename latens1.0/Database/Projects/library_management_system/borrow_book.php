<?php
session_start();
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$book_id = $_GET['id'];

// Begin transaction
$conn->begin_transaction();

try {
    // Update book status to "borrowed", set borrower_id and increment borrow_count
    $sql = "UPDATE books 
            SET status = 'borrowed', borrower_id = $user_id, borrow_count = borrow_count + 1 
            WHERE id = $book_id AND status = 'available'";

    if ($conn->query($sql) === TRUE) {
        // Commit the transaction
        $conn->commit();
        // Redirect to the borrow/return page after successful update
        header("Location: borrow_return.php");
        exit();
    } else {
        throw new Exception("Error updating record: " . $conn->error);
    }
} catch (Exception $e) {
    // Rollback transaction if an error occurs
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}

$conn->close();
?>
