<?php
$user = [
    'user_id' => 1,
    'name' => 'Bob',
    'display' => 'Awesome Bob!',
];

// copy our post data over our "entry"
if(isset($_POST) && count($_POST) > 0) {
    $entry = $_POST;
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
           <h2>Profile</h2>
            <form action="/profile.php" method="POST">
                <label>
                    Id: <input type="text" name="user_id" value="<?= $user['user_id'] ?>">
                </label>
                <label>
                    Name: <input type="text" name="name" value="<?= $user['name'] ?>">
                </label>
                <br>
                <label>
                    Display Name: <input type="text" name="display" value="<?= $user['display'] ?>">
                </label>
                <br>
                <label>
                    Password: <input type="password" name="password" value="">
                </label>
                <div>Leave blank to keep current password.</div>
                <br>
                <input type="submit" class="btn btn-primary" value="Save">
            </form>
            <div>
                <h3>Posted Content</h3>
                <pre>
<?php
if(isset($_POST) && count($_POST) > 0) {
    var_dump($_POST);
}
?>
                </pre>
            </div>
            <div>
                <h3>Errors</h3>
<?php
if(isset($_POST) && count($_POST) > 0) {
    $errors = [];
    
    if(empty($_POST['name'])) {
        $errors['name'] = 'A user must have a name';
    } elseif(!is_string($_POST['name'])) {
        $errors['name'] = 'Please use text for a user name';
    }

    if(empty($_POST['password'])) {
        $errors['password'] = 'A user must have a password';
    } elseif(!is_string($_POST['password'])) {
        $errors['password'] = 'Please use text for a user password';
    }

    if(!is_string($_POST['display'])) {
        $errors['display'] = 'Please use text for a display name';
    }

    // user_id must exist and be intval
    if(empty($_POST['user_id'])) {
        $errors['user_id'] = 'A user must have an user id';
    } elseif(!is_numeric($_POST['user_id']) || !is_int($_POST['user_id'] + 0)) {
        $errors['user_id'] = 'User id must be a number';
    }
    
    foreach($errors as $error) {
        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
    }
}
?>
            </div>
        </div>
    </body>
</html>