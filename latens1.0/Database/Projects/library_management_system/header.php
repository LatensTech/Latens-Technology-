<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="css/style.css"> <!-- Link to the stylesheet -->
</head>
<header>
    <div class="logo">
        <h1>Library Management System</h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="view_books.php">Books</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="borrow_return.php">Borrow/Return</a></li>
            <!-- New Buttons for Login and Register -->
            <?php if (!isset($_SESSION['user_id'])): ?>
                <li><a href="login.php" class="btn">Login</a></li>
                <li><a href="register.php" class="btn">Register</a></li>
            <?php endif; ?>
        </ul>
        <form method="GET" action="search_books.php" class="search-form">
                <input type="text" name="search" placeholder="Search books..." required>
                <button type="submit">Search</button>
            </form>
    </nav>
</header>
