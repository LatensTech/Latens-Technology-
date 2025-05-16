<?php
include('config.php');
session_start();

// Check if the user is logged in and is an admin
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Check if the book ID is passed
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];

    // Fetch book details from the database to show the confirmation
    $sql = "SELECT * FROM books WHERE id = '$book_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "<p class='error'>Book not found.</p>";
        exit();
    }
}

// Handle the deletion after confirmation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
    // Delete the book from the database
    $sql = "DELETE FROM books WHERE id = '$book_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Book deleted successfully!</p>";
        header("Location: view_books.php"); // Redirect back to the view books page
        exit();
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
?>

<?php include('header.php'); ?>

<section class="main-content">
    <h2>Delete Book</h2>

    <!-- Confirmation form for deleting the book -->
    <div class="confirm-delete">
        <p>Are you sure you want to delete the book titled <strong><?php echo $book['title']; ?></strong>?</p>
        <form method="POST" action="delete_book.php?id=<?php echo $book_id; ?>">
            <button type="submit" name="confirm_delete" class="delete-btn">Yes, Delete</button>
            <a href="view_books.php" class="cancel-btn">Cancel</a>
        </form>
    </div>
</section>

<?php include('footer.php'); ?>
