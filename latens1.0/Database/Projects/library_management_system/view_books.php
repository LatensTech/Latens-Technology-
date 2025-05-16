<?php
session_start();
include('header.php');
include('config.php');

// Allow access for both 'user' and 'admin' roles, redirect others to login
if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['user', 'admin'])) {
    header("Location: login.php");
    exit();
}

// Admin-only Add Book button
if ($_SESSION['role'] == 'admin') {
    echo "<div class='add-book-container'>";
    echo "<a href='add_book.php' class='add-book-btn'>Add New Book</a>";
    echo "</div>";
}

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<div class='table-container'><table>";
    echo "<thead><tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>ISBN</th><th>Genre</th><th>Description</th><th>Status</th><th>Actions</th></tr></thead>";
    echo "<tbody>";
    while ($row = $result->fetch_assoc()) {
        // Display book details along with genre and description
        echo "<tr><td>" . $row['id'] . "</td><td>" . $row['title'] . "</td><td>" . $row['author'] . "</td><td>" . $row['year'] . "</td><td>" . $row['isbn'] . "</td>";
        echo "<td>" . $row['genre'] . "</td><td>" . $row['description'] . "</td><td>" . $row['status'] . "</td>";

        // Display Borrow/Return button for all users
        if ($row['status'] == 'available') {
            echo "<td><a href='borrow_book.php?id=" . $row['id'] . "' class='action-btn borrow-btn'>Borrow</a></td>";
        } else {
            echo "<td><a href='return_book.php?id=" . $row['id'] . "' class='action-btn return-btn'>Return</a></td>";
        }

        // Only show Edit/Delete for admins
        if ($_SESSION['role'] == 'admin') {
            echo "<td><a href='edit_book.php?id=" . $row['id'] . "' class='action-btn edit-btn'>Edit</a> ";
            echo "<a href='delete_book.php?id=" . $row['id'] . "' class='action-btn delete-btn'>Delete</a></td>";
        } else {
            echo "<td></td>";  // Empty cell for regular users
        }
        echo "</tr>";
    }
    echo "</tbody></table></div>";
} else {
    echo "<p>No books found.</p>";
}

include('footer.php');
?>
