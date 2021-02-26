<?php
declare(strict_types=1);

use JetBrains\PhpStorm\Pure;

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'classes/Post.php';
require 'classes/PostLoader.php';

session_start();
$allPosts = "all_posts.txt";
const MAX_POSTS = 20;

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['author'])){
        $title = test_input($_POST['title']);
        $content = test_input($_POST['content']);
        $author = test_input($_POST['author']);
        $userInput = new Post($title, $content, $author);
        $postLoader = new PostLoader();
        $postLoader->writePost($allPosts, $userInput);
        $postLoader->setAllPosts($allPosts);
        header('Location: index.php'); //method to avoid double submit
        exit;
    }
}

if(!isset($_POST['run'])){
    $postLoader = new PostLoader();
    $postLoader->setAllPosts($allPosts);
}

if(isset($_POST['clear'])){
    session_destroy();
    header('Location: index.php');
    exit;
}
//validation
#[Pure] function test_input($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!doctype html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0"
            crossorigin="anonymous"></script>
    <link href="style.css" rel="stylesheet">
    </style>
    <title>GuestBook - PHP</title>
</head>
<body>
<form method="post" class="row g-3 was-validated" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
    <div class="col-md-3">
        <input type="text" class="form-control textField is-invalid" id="validationText" name="author" placeholder="Your name please..." required>
        <label for="author validationText" class="form-label"></label>
        <span class="error">* Required field</span>
    </div>
    <div class="col-md-3">
        <input type="text" class="form-control textField is-invalid" name="title" placeholder="Title of your comment..." required>
        <label for="title validationText" class="form-label"></label>
        <span class="error">* Required field</span>
    </div>
    <div class="row mt-3">
        <div class="col-6">
            <textarea class="form-control textField is-invalid" rows="5" name="content"
                              placeholder="Leave a comment behind..." required></textarea>
            <label for="content validationTextarea" class="form-label"></label>
            <span class="error">* Required field</span>
        </div>
        <div class="col-1 d-flex flex-column">
            <button class="btn btn-success btn-sm m-1" type="submit" name="run">Send</button>
            <button class="btn btn-info btn-sm m-1" type="submit" name="clear">Clear</button>
        </div>
    </div>
</form>
<div class="comments">
<?php
//load comments
if(isset($postLoader)){
    foreach($postLoader->getAllPosts() as $i => $post){
        echo "<br>";
        echo "Comment written on: " . $postLoader->getAllPosts()[$i]['date'] . PHP_EOL;
        echo "<br>";
        echo "Author: " .$postLoader->getAllPosts()[$i]['author'] . PHP_EOL;
        echo "<br>";
        echo "Title: " ."<strong>" . $postLoader->getAllPosts()[$i]['title'] . "</strong>" . PHP_EOL;
        echo "<br>";
        echo "Your comment: " .$postLoader->getAllPosts()[$i]['content'] . PHP_EOL;
        echo "<br>";
        if ($i === MAX_POSTS -1){
            break;
        }
    }
}

?>
</div>
</body>
</html>