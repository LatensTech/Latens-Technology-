<?php
include('config.php');
session_start();

// Check if the user is logged in and is an admin
if ($_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Handle form submission to add new book
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year = $_POST['year'];
    $isbn = $_POST['isbn'];
    $status = $_POST['status'];
    $genre = $_POST['genre'];  // Added genre
    $description = $_POST['description'];  // Added description

    // Insert the new book into the database with genre and description
    $sql = "INSERT INTO books (title, author, year, isbn, status, genre, description) 
            VALUES ('$title', '$author', '$year', '$isbn', '$status', '$genre', '$description')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success'>Book added successfully!</p>";
        header("Location: view_books.php"); // Redirect to view_books page after success
    } else {
        echo "<p class='error'>Error: " . $conn->error . "</p>";
    }
}

include('header.php'); // Include header for consistent styling

?>

<div class="form-container">
    <h2>Add New Book</h2>
    <form method="POST" action="add_book.php">
        <label for="title">Title:</label><br>
        <input type="text" name="title" id="title" required><br>

        <label for="author">Author:</label><br>
        <input type="text" name="author" id="author" required><br>

        <label for="year">Year:</label><br>
        <input type="text" name="year" id="year" required><br>

        <label for="isbn">ISBN:</label><br>
        <input type="text" name="isbn" id="isbn" required><br>

        <label for="status">Status:</label><br>
        <select name="status" id="status" required>
            <option value="available">Available</option>
            <option value="borrowed">Borrowed</option>
        </select><br>

        <!-- Added Genre field -->
        <label for="genre">Genre:</label><br>
        <input type="text" name="genre" id="genre" required><br>

        <!-- Added Description field -->
        <label for="description">Description:</label><br>
        <textarea name="description" id="description" rows="4" required></textarea><br>

        <button type="submit">Add Book</button>
    </form>
</div>

<?php
include('footer.php'); // Include footer for consistency
?>
