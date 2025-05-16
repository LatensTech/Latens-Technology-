<?php
session_start();
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit();
}

include('config.php');
?>

<?php include('header.php'); ?>

<section class="main-content">
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
        <p>You are logged in as a <?php echo ucfirst($_SESSION['role']); ?>.</p>
        <div class="dashboard-links">
            <a href="view_books.php" class="dashboard-btn">View Books</a><br>
            <a href="logout.php" class="dashboard-btn">Logout</a>
        </div>
    </div>
</section>

<?php include('footer.php'); ?>
