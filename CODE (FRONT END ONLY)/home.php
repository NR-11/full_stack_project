<?php
include 'connect.php';

//session
session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: login.php");
    exit();
}

//import article
$query = "SELECT * FROM articles ORDER BY Article_id DESC";
$resault = mysqli_query($conn, $query);


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home - Insider</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-DQvkBjpPgn7RC31MCQoOeC9TI2kdqa4+BSgNMNj8v77fdC77Kj5zpWFTJaaAoMbC" crossorigin="anonymous">
    <link rel="stylesheet" href="navbar.css">
    <style>
    body {
        background-color: #1e1e1e;
        color: white;
        font-family: Arial, Helvetica, sans-serif;
        padding-top: 100px;
    }

    .title-section {
        background-color: #333a40;
        text-align: center;
        padding: 40px;
        margin-bottom: 30px;
    }

    .title-section h1 {
        font-size: 48px;
        margin-bottom: 20px;
    }

    .title-section p {
        font-size: 19px;
    }

    .card {
        background-color: #252525;
        color: white;
        margin-bottom: 30px;
        transition: transform 0.3s ease-in-out;
        height: 400px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 600px;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 15px rgba(255, 255, 255, 0.1);

    }

    .card-img-top {
        height: 500px;
        object-fit: cover;
    }

    .card-body {
        background-color: #333;
        box-shadow: 0 4px 10px rgba(255, 255, 255, 0.1);
        flex-grow: 1;
        overflow: hidden;
        padding: 15px;
    }

    .card-title {
        font-size: 18px;
        font-weight: bold;
    }

    .card-text {
        font-size: 14px;
        line-height: 1.5;
        max-height: 6em;
        overflow: hidden;
    }

    .btn {
        margin-top: auto;
        margin-bottom: 40px;
    }

    .btn:hover {
        background-color: #4d92ec;
    }
    </style>

</head>

<body>
    <?php include 'navbar.php'; ?>


    <div class="title-section">
        <?php echo "<h1>Welcome " . $_SESSION['F_Name'] . " To Insider News</h1>"; ?>
        <p>Stay updated with the latest news and articles across the world.</p>
    </div>
    <div class="container">
        <div class="row">

            <?php
            while ($row = mysqli_fetch_array($resault)) {
                echo "<div class='col-lg-4 col-md-6'>";
                echo  "<div class='card'>";
                echo "<img src='" . $row['Image'] . "' class='card-img-top'>";
                echo  "<div class='card-body'>";
                echo   "<h5 class='card-title'>" . $row['Title'] . "</h5>";
                echo   "<p class='card-text'>" . $row['Content'] . "...</p>";
                echo   "<a href='article.php?Article_id={$row['Article_id']}' class='btn btn-primary'><b>Read More</b></a>";
                echo    "</div>";
                echo    "</div>";
                echo    "</div>";
            }
            ?>

        </div>
    </div>
    <?php include 'footer.html'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.4/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YUe2LzesAfftltw+PEaao2tjU/QATaW/rOitAq67e0CT0Zi2VVRL0oC4+gAaeBKu" crossorigin="anonymous">
    </script>
</body>

</html>