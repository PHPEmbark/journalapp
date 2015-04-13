<?php
$entry = [
    'entry_id' => 1,
    'title' => 'My title',
    'article' => 'Awesome article is here!',
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
            <h2>Edit Entry</h2>
            <form action="/edit.php" method="POST">
                <label>
                    Id: <input type="text" name="entry_id" value="<?= $entry['entry_id'] ?>">
                </label>
                <label>
                    Title: <input type="text" name="title" value="<?= $entry['title'] ?>">
                </label>
                <br>
                <label>
                    Article:
                    <br>
                    <textarea name="article" cols="60" rows="20"><?= $entry['article'] ?></textarea>
                </label>
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

    // entry_id must exist and be intval
    if(empty($_POST['entry_id'])) {
        $errors['entry_id'] = 'An entry must have an entry id';
    } elseif(!is_numeric($_POST['entry_id']) || !is_int($_POST['entry_id'] + 0)) {
        $errors['entry_id'] = 'Entry id must be a number';
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