<?php
include('config.php');
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Handle the search query
$search_query = '';
if (isset($_GET['search'])) {
    $search_query = $_GET['search'];
}

// Fetch books based on search query
$sql = "SELECT * FROM books WHERE title LIKE '%$search_query%' OR author LIKE '%$search_query%' OR isbn LIKE '%$search_query%'";
$result = $conn->query($sql);

?>

<?php include('header.php'); ?>

<section class="main-content">
    <h2>Search Results for: "<?php echo htmlspecialchars($search_query); ?>"</h2>

    <?php if ($result->num_rows > 0) { ?>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Year</th>
                        <th>ISBN</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo $row['author']; ?></td>
                            <td><?php echo $row['year']; ?></td>
                            <td><?php echo $row['isbn']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td>
                                <?php if ($row['status'] == 'available') { ?>
                                    <a href="borrow_book.php?id=<?php echo $row['id']; ?>" class="borrow-btn">Borrow</a>
                                <?php } else { ?>
                                    <a href="return_book.php?id=<?php echo $row['id']; ?>" class="return-btn">Return</a>
                                <?php } ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    <?php } else { ?>
        <p>No results found for "<?php echo htmlspecialchars($search_query); ?>".</p>
    <?php } ?>
</section>

<?php include('footer.php'); ?>
