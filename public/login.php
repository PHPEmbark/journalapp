<?php
session_start();

$errors = [];

if(isset($_POST) && count($_POST) > 0) {
    
    if(empty($_POST['name'])) {
        $errors['name'] = 'Please enter your name';
    }

    if(empty($_POST['password'])) {
        $errors['password'] = 'Please enter your password';
    }

    if(count($errors) == 0) {
        $_SESSION['user_id'] = 1;
        session_write_close();
        header('Location: /index.php');
        exit;
    }
}

if(isset($_SESSION['user_id'])) {
   header('Location: /index.php');
   exit;
}
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
           <h2>Login</h2>
            <form action="/login.php" method="POST">
                <label>
                    Name: <input type="text" name="name" value="">
                </label>
                <br>
                <label>
                    Password: <input type="password" name="password" value="">
                </label>
                <br>
                <input type="submit" class="btn btn-primary" value="Login">
            </form>
                            <h3>Errors</h3>
<?php
    foreach($errors as $error) {
        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
    }
?>
            </div>
        </div>
    </body>
</html>