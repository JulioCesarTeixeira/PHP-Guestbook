<?php
declare(strict_types=1);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'classes/Post.php';
require 'classes/PostLoader.php';
require 'templates/partials/header.php';
require 'templates/partials/footer.php';

session_start();
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <title>BlackJack - OOP</title>
</head>
<body>
<form method="POST" class="row g-3">
    <div class="col-md-3">
        <label for="exampleFormControlInput1" class="form-label">Email address</label>
        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
    <div class="col-md-3">
        <label for="" class="form-label">Email</label>
        <input type="text" class="form-control">
    </div>
    <div class="col-md-3">
        <label for="" class="form-label">Email</label>
        <input type="text" class="form-control">
    </div>
    <div class="row mt-3">
        <div class="col-9">
            <textarea class="form-control" rows="3" id="sent_text" placeholder="Just write some text.."></textarea>
        </div>
        <div class="col-auto d-flex flex-column">
            <button class="btn btn-success btn-sm m-1" type="submit">Send</button>
            <button class="btn btn-info btn-sm m-1" type="submit">Clear</button>
        </div>
    </div>
</form>