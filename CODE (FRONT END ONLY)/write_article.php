<?php
session_start();
include 'connect.php';

//check if the session is set
if (isset($_SESSION['ID'])) {
    $session_id = $_SESSION['ID'];
    $session_email = $_SESSION['Email'];
    $session_pass = $_SESSION['Pass'];
} else {
    header("Location: login_admin.php");
    exit();
}

if (isset($_POST['article_title']) && isset($_POST['upload']) && isset($_POST['article_content'])) {
    $article_title = htmlspecialchars($_POST['article_title']);
    $article_content = htmlspecialchars($_POST['article_content']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {

        $image_name = uniqid() . "_" . basename($_FILES['image']['name']);
        $image_path = "upload/" . $image_name;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            $upload_article = "INSERT INTO articles (Title, Content, Image) 
                               VALUES ('$article_title', '$article_content', '$image_path')";
            $resault = mysqli_query($conn, $upload_article);
            if ($resault) {
                echo "<script>alert('Article uploaded successfully');</script>";
                header("Location: admin_panal.php");
                exit();
            } else {
                echo "<script>alert('Error uploading article');</script>";
            }
        } else {
            echo "<script>alert('Failed to move uploaded image');</script>";
        }
    } else {
        echo "<script>alert('Image not uploaded properly');</script>";
    }
} else {
    $article_title = null;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Write Article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #1e1e2e;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .article-container {
        background: rgba(255, 255, 255, 0.1);
        padding: 30px;
        border-radius: 10px;
        height: 700px;
        width: 1000px;
    }

    h2 {
        text-align: center;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.2);
        border: none;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    textarea {
        resize: none;
    }
    </style>
</head>

<body>
    <div class="article-container">
        <h2>Write an Article</h2>
        <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="mb-3">
                <label class="form-label"><b>Upload Image :</b></label>
                <input type="file" name="image" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Article Title :</b></label>
                <input type="text" name="article_title" class="form-control" placeholder="Enter article title" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><b>Article Content :</b></label>
                <textarea class="form-control" name="article_content" rows="14"
                    placeholder="Write your article here ..." required></textarea>
            </div>
            <button type="submit" name="upload" class="btn btn-primary w-100"><b>Share</b></button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>