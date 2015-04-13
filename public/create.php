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
            <h2>New Entry</h2>
            <form action="/create.php" method="POST">
                <label>
                    Title: <input type="text" name="title" value="">
                </label>
                <br>
                <label>
                    Article:
                    <br>
                    <textarea name="article" cols="60" rows="20"></textarea>
                </label>
                <br>
                <input type="submit" class="btn btn-primary" value="Create">
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
    
    if(empty($_POST['title'])) {
        $errors['title'] = 'An entry must have a title';
    } elseif(!is_string($_POST['title'])) {
        $errors['title'] = 'Please use text for an entry title';
    }

    // article must a string and must be not empty
    if(empty($_POST['article'])) {
        $errors['article'] = 'An entry must have a article';
    } elseif(!is_string($_POST['article'])) {
        $errors['article'] = 'Please use text for an entry article';
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