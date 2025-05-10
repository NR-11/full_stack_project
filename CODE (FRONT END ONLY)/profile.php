<?php
include 'connect.php';
// Start the session
session_start();
if (!isset($_SESSION['Email'])) {
    header("Location: login.php");
    exit();
}
// Check if the session is set
$username = $_SESSION['F_Name'] . " " . $_SESSION['L_Name'];
$session_email = $_SESSION['Email'];
$session_pass = $_SESSION['Pass'];
$session_id = $_SESSION['ID'];

//logout
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

//delete account
if (isset($_POST['delete'])) {
    $query = "DELETE FROM users WHERE Email='$session_email' AND Pass='$session_pass'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        session_unset();
        session_destroy();
        header("Location: insider.html");
        exit();
    } else {
        echo "<script>alert('Error deleting account. Please try again.');</script>";
    }
}

//edit profile
if (isset($_POST['edit'])) {
    $f_name = $_POST['f_name'];
    $l_name = $_POST['l_name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $query = "UPDATE users SET F_Name='$f_name', L_Name='$l_name', Email='$email', Pass='$pass' WHERE Email='$session_email' 
    AND Pass='$session_pass' AND User_id='$session_id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $_SESSION['F_Name'] = $f_name;
        $_SESSION['L_Name'] = $l_name;
        $_SESSION['Email'] = $email;
        $_SESSION['Pass'] = $pass;
        header("Location: profile.php");
        exit();
    } else {
        echo "<script>alert('Error updating profile. Please try again.');</script>";
    }
}

// Comments Query
$comment_query = "SELECT * FROM comments WHERE User_id='$session_id'";
$comment_result = mysqli_query($conn, $comment_query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="navbar.css">
    <style>
    body {
        background-color: #1c1c1c;
        color: #e0e0e0;
        padding-top: 100px;
    }

    .container {
        width: 800px;
        padding: 40px;
        background: #292929;
        border-radius: 10px;
    }

    .profile-info {
        margin-bottom: 20px;
    }

    .btn-edit {
        margin-bottom: 20px;
    }

    .comments-section {
        margin-top: 30px;
    }

    .comment-card {
        background: #383838;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .comment-title {
        font-weight: bold;
        color: #f8f9fa;
    }

    .comment-card div {
        display: flex;
        align-items: center;
    }

    .comment-card i {
        margin-right: 10px;
    }

    h3 {
        text-align: center;
    }

    .modal .form-control {
        width: 100% !important;
        margin: 5px 0;
        float: none !important;
        display: block;
    }
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="container">
        <h2 class="text-center">User Profile</h2>

        <div class="profile-info">
            <p><b>Username:</b> <?php echo $username; ?></p>
            <p><b>Email:</b> <?php echo $session_email; ?></p>
            <p><b>Password:</b> <?php echo $session_pass; ?></p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#edit_profile_modal">Edit Profile</button>
        </div>

        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button type="submit" name="delete" class="btn btn-danger">Delete Account</button>
            <button type="submit" name="logout" class="btn btn-warning">Logout</button>
        </form>
        <hr>
        <div class="comments-section">
            <h3>User Comments</h3>
            <?php
            // Loop through each comment and display its content along with the article title
            while ($comment_row = mysqli_fetch_array($comment_result)) {
                $article_id = $comment_row['Article_id']; // Get the Article_id for each comment

                // Query to get the article title based on Article_id
                $article_title_query = "SELECT Title FROM articles WHERE Article_id='$article_id'";
                $article_title_result = mysqli_query($conn, $article_title_query);

                // Check if the article exists
                if ($article_title_row = mysqli_fetch_array($article_title_result)) {
                    $article_title = $article_title_row['Title'];
                } else {
                    $article_title = "No article found";
                }

                echo '<div class="comment-card">';
                echo '<div>';
                echo '<i class="fa-sharp fa-solid fa-newspaper"></i>';
                echo '<p class="comment-title">' . $article_title . '</p>';
                echo '</div>';
                echo '<div>';
                echo '<i class="fa-sharp fa-solid fa-comment"></i>';
                echo "<p>" . $comment_row['Content'] . "</p>";
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div>
        <!-- Modal -->
        <div class="modal fade" id="edit_profile_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-header bg-dark">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div class="mb-3">
                                <input type="text" name="f_name" class="form-control" placeholder="First Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="l_name" class="form-control" placeholder="Last Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="password" name="pass" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="edit" class="btn btn-success w-100">Save changes</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>