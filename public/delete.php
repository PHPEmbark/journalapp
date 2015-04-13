<?php
$entry = [
    'entry_id' => 1,
    'title' => 'My title',
    'article' => 'Awesome article is here!',
];

// copy our post data over our "entry"
if(isset($_POST) && count($_POST) > 0) {
    $entry['entry_id'] = $_POST['entry_id'];
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
            <h2>Delete Entry</h2>
            <form action="/delete.php" method="POST">
                <label>
                    Id: <input type="text" name="entry_id" value="<?= $entry['entry_id'] ?>">
                </label>
                 <section>
                    <div class="row">
                        <div class="col-xs-12">
                            <h3><?= htmlspecialchars($entry['title'], ENT_COMPAT, 'UTF-8') ?></h3>
                        </div>
                    </div>
                </section>
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