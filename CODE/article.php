<?php
session_start();

include 'connect.php';
// Start the session
@session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: login.php");
    exit();
}
//Check if the session is set
$username = $_SESSION['F_Name'] . " " . $_SESSION['L_Name'];
$session_email = $_SESSION['Email'];
$session_pass = $_SESSION['Pass'];
$session_id = $_SESSION['ID'];

//get article id from url
if (isset($_GET['Article_id'])) {
    $article_id = $_GET['Article_id'];
    $get_article_qury = "SELECT * FROM articles WHERE Article_id='$article_id'";
    $get_article_result = mysqli_query($conn, $get_article_qury);
    if (mysqli_num_rows($get_article_result) == 0) {
        header("Location: home.php");
        exit();
    }
} else {
    header("Location: home.php");
    exit();
}

//comment section
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit']) && isset($_POST['comment_box'])) {
    $comment_box = htmlspecialchars($_POST['comment_box']);
    $comment_query = "INSERT INTO comments (Content, User_id, Article_id) VALUES ('$comment_box', '$session_id', '$article_id')";
    $comment_result = mysqli_query($conn, $comment_query);
    if ($comment_result) {
        header("Location: article.php?Article_id=" . $article_id);
        exit();
    } else {
        echo "<script>alert('Error adding comment');</script>";
    }
}



//get comments
$comment_query = "
    SELECT comments.Content, users.F_Name, users.L_Name 
    FROM comments 
    JOIN users ON comments.User_id = users.User_id 
    WHERE comments.Article_id = '$article_id'
";
$comment_result = mysqli_query($conn, $comment_query);





?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="navbar.css">
    <style>
    body {
        background-color: #121212;
        color: white;
        padding-top: 100px;
    }

    .container {
        background-color: #292929;
        width: 1100px;
    }

    .news-image {
        width: 100%;
        height: auto;
        border-radius: 8px;
        margin-bottom: 10px;

    }

    .news-title {
        text-align: center;
    }

    .news-content {
        margin-top: 20px;
        color: #ccc;
        font-size: 19px;
    }

    hr {
        background-color: white;
    }

    .comment-section {
        background-color: #1f1f1f;
        border-radius: 8px;
        padding: 20px;
    }

    .comment-box textarea {
        background-color: #333;
        padding: 15px;
        border-radius: 8px;
        margin-top: 10px;
        width: 100%;
        resize: none;
    }

    .btn {
        margin-top: 10px;
    }

    .comment {
        background-color: #333;
        margin-top: 20px;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
    }

    .comment-author {
        color: #00aaff;
    }

    .comment-text {
        color: #cacaca;
    }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <?php
        if ($row = mysqli_fetch_array($get_article_result)) {
            echo '<img src="' . $row['Image'] . '" class="news-image">';
            echo '<h1 class="news-title">' . $row['Title'] . '</h1>';
            echo '<div class="news-content">';
            echo  '<p>' . $row['Content'] . '</p>';
            echo  '</div>';
        }
        ?>



        <hr>
        <div class="comment-section">
            <h3>Comments: </h3>
            <div class="comment-box">
                <form method="POST" action="?Article_id=<?php echo $article_id; ?>">
                    <h5>Leave a Comment:</h5>
                    <textarea name="comment_box" placeholder="Write Your Comment Here ..." rows="4"
                        class="text-area"></textarea>
                    <button type="submit" name="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            </div>
            <?php
            while ($comment_row = mysqli_fetch_array($comment_result)) {
                echo '<div class="comment">';
                echo '<p class="comment-author"><b>' . $comment_row['F_Name'] . " " . $comment_row['L_Name'] . '</b></p>';
                echo '<p class="comment-text">' . $comment_row['Content'] . '</p>';
                echo '</div>';
            }
            ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq"
                crossorigin="anonymous">
            </script>

</body>

</html>