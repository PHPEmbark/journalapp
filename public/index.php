<?php
session_start();
?>
<!doctype html>
<html>
    <head>
        <title>My Journal</title>
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap.theme-min.css">
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="/">Journal</a>
                </div>
            </div>
        </nav>
        <div class="container">
            <h1>Forms</h1>
            <?php if (isset($_SESSION['user_id'])): ?>
                <p>Welcome, user <?php echo htmlentities($_SESSION['user_id']); ?></p>
            <?php endif; ?>
            <p><a href="/create.php">Create an Entry</a></p>
            <p><a href="/edit.php">Edit an Entry</a></p>
            <p><a href="/delete.php">Delete an Entry</a></p>
            <p><a href="/profile.php">Edit a Profile</a></p>
            <p><a href="/login.php">Login</a></p>
            <p><a href="/logout.php">Logout</a></p>
        </div>
    </body>
</html>