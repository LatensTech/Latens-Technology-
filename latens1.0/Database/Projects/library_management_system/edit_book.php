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

    // Fetch book details from the database
    $sql = "SELECT * FROM books WHERE id = '$book_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Book not found.";
        exit();
    }
}

// Handle form submission to update book details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];
    $status = $_POST['status'];  // Include status field to update the book status
    $genre = $_POST['genre'];    // New genre field
    $description = $_POST['description']; // New description field

    // Update the book details in the database
    $sql = "UPDATE books SET title='$title', author='$author', year='$year', isbn='$isbn', status='$status', genre='$genre', description='$description' WHERE id='$book_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Book updated successfully!</p>";
        header("Location: view_books.php"); // Redirect back to the view books page
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}
?>

<?php include('header.php'); ?> <!-- Include Header -->

<div class="form-container">
    <h2>Edit Book</h2>
    <form method="POST" action="edit_book.php?id=<?php echo $book_id; ?>">
        <label for="title">Title:</label><br>
        <input type="text" name="title" id="title" value="<?php echo $book['title']; ?>" required><br>

        <label for="author">Author:</label><br>
        <input type="text" name="author" id="author" value="<?php echo $book['author']; ?>" required><br>

        <label for="year">Year:</label><br>
        <input type="text" name="year" id="year" value="<?php echo $book['year']; ?>" required><br>

        <label for="isbn">ISBN:</label><br>
        <input type="text" name="isbn" id="isbn" value="<?php echo $book['isbn']; ?>" required><br>

        <label for="status">Status:</label><br>
        <select name="status" id="status" required>
            <option value="available" <?php echo $book['status'] == 'available' ? 'selected' : ''; ?>>Available</option>
            <option value="borrowed" <?php echo $book['status'] == 'borrowed' ? 'selected' : ''; ?>>Borrowed</option>
        </select><br>

        <label for="genre">Genre:</label><br>
        <input type="text" name="genre" id="genre" value="<?php echo $book['genre']; ?>" required><br> <!-- New genre field -->

        <label for="description">Description:</label><br>
        <textarea name="description" id="description" required><?php echo $book['description']; ?></textarea><br> <!-- New description field -->

        <button type="submit">Update Book</button>
    </form>
</div>

<?php include('footer.php'); ?> <!-- Include Footer -->
