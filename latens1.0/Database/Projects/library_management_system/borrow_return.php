<?php
session_start();
include('header.php');
include('config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Check if the user is an admin
$user_sql = "SELECT role FROM users WHERE id = $user_id";
$user_result = $conn->query($user_sql);
$user = $user_result->fetch_assoc();
$is_admin = $user && $user['role'] === 'admin';

// Fetch books borrowed by the user
$borrowed_sql = "SELECT * FROM books WHERE borrower_id = $user_id AND status = 'borrowed'";
$borrowed_result = $conn->query($borrowed_sql);

// Fetch books available for borrowing
$available_sql = "SELECT * FROM books WHERE status = 'available'";
$available_result = $conn->query($available_sql);

// Additional queries for admin view
if ($is_admin) {
    // Fetch all borrowed books with user details
    $admin_borrowed_sql = "
        SELECT books.id, books.title, books.author, books.year, books.isbn, users.username AS borrowed_by
        FROM books
        LEFT JOIN users ON books.borrower_id = users.id
        WHERE books.status = 'borrowed'
    ";
    $admin_borrowed_result = $conn->query($admin_borrowed_sql);

    // Fetch most borrowed books using borrow_count from books table
    $most_borrowed_sql = "
        SELECT id, title, author, year, isbn, borrow_count
        FROM books
        ORDER BY borrow_count DESC
        LIMIT 5
    ";
    $most_borrowed_result = $conn->query($most_borrowed_sql);
}
?>

<section class="main-content">
    <?php if ($is_admin): ?>
        <h2>Admin View - Borrowed Books with Borrower Information</h2>
        <?php if ($admin_borrowed_result->num_rows > 0): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>ISBN</th><th>Borrowed By</th></tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $admin_borrowed_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['author']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['isbn']; ?></td>
                                <td><?php echo $row['borrowed_by']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No borrowed books.</p>
        <?php endif; ?>

        <h2>Most Borrowed Books</h2>
        <?php if ($most_borrowed_result->num_rows > 0): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>ISBN</th><th>Times Borrowed</th></tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $most_borrowed_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['author']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['isbn']; ?></td>
                                <td><?php echo $row['borrow_count']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No data on most borrowed books.</p>
        <?php endif; ?>
    <?php else: ?>
        <h2>Borrowed Books</h2>
        <?php if ($borrowed_result->num_rows > 0): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>ISBN</th><th>Return</th></tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $borrowed_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['author']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['isbn']; ?></td>
                                <td><a href="return_book.php?id=<?php echo $row['id']; ?>" class="action-btn return-btn">Return</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No borrowed books.</p>
        <?php endif; ?>

        <h2>Available Books</h2>
        <?php if ($available_result->num_rows > 0): ?>
            <div class="table-container">
                <table>
                    <thead>
                        <tr><th>ID</th><th>Title</th><th>Author</th><th>Year</th><th>ISBN</th><th>Borrow</th></tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $available_result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['title']; ?></td>
                                <td><?php echo $row['author']; ?></td>
                                <td><?php echo $row['year']; ?></td>
                                <td><?php echo $row['isbn']; ?></td>
                                <td><a href="borrow_book.php?id=<?php echo $row['id']; ?>" class="action-btn borrow-btn">Borrow</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p>No available books to borrow.</p>
        <?php endif; ?>
    <?php endif; ?>
</section>

<?php include('footer.php'); ?>
