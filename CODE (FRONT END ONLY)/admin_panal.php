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

//logout 
if (isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("location: login_admin.php");
    exit();
}

//add user/admin form
if (isset($_POST['add'])) {
    $f_name = htmlspecialchars($_POST['f_name']);
    $l_name = htmlspecialchars($_POST['l_name']);
    $email = htmlspecialchars($_POST['email']);
    $pass = htmlspecialchars($_POST['pass']);
    $role = htmlspecialchars($_POST['role']);
    if ($role == 'admin') {
        $add_admin = "INSERT INTO admins (F_Name , L_Name , Pass , Email) 
        VALUES ('$f_name' , '$l_name', '$pass','$email')";
        $resault =  mysqli_query($conn, $add_admin);
        if ($resault) {
            echo "<script>alert('Admin Added Successfully');</script>";
            header("location: admin_panal.php");
            exit();
        }
    } else if ($role == 'user') {
        $add_user = "INSERT INTO users (F_Name , L_Name , Pass , Email) 
        VALUES ('$f_name' , '$l_name', '$pass','$email')";
        $resault =  mysqli_query($conn, $add_user);
        if ($resault) {
            echo "<script>alert('User Added Successfully');</script>";
            header("location: admin_panal.php");
            exit();
        }
    } else {
        echo "<script>alert('Error While Addmin User/Admin');</script>";
        header("location: admin_panal.php");
        exit();
    }
}

//show admins/users
$admin_query = "SELECT * FROM admins";
$admin_result = mysqli_query($conn, $admin_query);
$users_query = "SELECT * FROM users";
$users_result = mysqli_query($conn, $users_query);

//delete admin
if (isset($_POST['delete_admin_id'])) {
    $delete_admin = $_POST['delete_admin_id'];
    $delete_admin_query = "DELETE FROM admins WHERE Admin_id ='$delete_admin'";
    $delete_admin_result = mysqli_query($conn, $delete_admin_query);
    if ($delete_admin_result) {
        echo "<script>alert('Admin Deleted Successfully');</script>";
        header("location: admin_panal.php");
        exit();
    } elseif (!$delete_admin_result) {
        echo "<script>alert('Error While Deleting Admin');</script>";
        header("location: admin_panal.php");
        exit();
    }
}

//delete user
if (isset($_POST['delete_user_id'])) {
    $delete_user = $_POST['delete_user_id'];
    $delete_user_query = "DELETE FROM users WHERE User_id = '$delete_user'";
    $delete_user_result = mysqli_query($conn, $delete_user_query);
    if ($delete_user_result) {
        echo "<script>alert('User Deleted Successfully');</script>";
        header("location: admin_panal.php");
        exit();
    } elseif (!$delete_user_result) {
        echo "<script>alert('Error While Deleting User');</script>";
        header("location: admin_panal.php");
        exit();
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1e1e1e;
            color: #ffffff;
        }

        .container {
            margin-top: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #292929;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        h2 {
            margin-left: 50px;
        }

        .card {
            background-color: #292929;
            color: white;
        }

        .card-header {
            background-color: rgb(9, 9, 37);
        }

        .btn {
            margin: 10px;
        }

        .btn-delete {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .btn-delete:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>

    <div class="container">
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="header">
                <h2>Admin Panal</h2>
                <div class="btn-group">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                        data-bs-target="#addusermodal">Add
                        User/Admin</button>
                    <a href="write_article.php" class="btn btn-warning">Write Article</a>
                    <button type="submit" name="logout" class="btn btn-danger">Logout</button>
                </div>
            </div>
        </form>
        <!-- Users Table -->
        <div class="card mb-4">
            <div class="card-header"><b>ADMINS</b></div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_array($admin_result)) {
                            echo "<tr>";
                            echo "<td>" . $row['Admin_id'] . "</td>";
                            echo "<td>" . $row['F_Name'] . "</td>";
                            echo "<td>" . $row['L_Name'] . "</td>";
                            echo "<td>" . $row['Email'] . "</td>";
                            echo "<td>" . $row['Pass'] . "</td>";
                            echo "<td>" . $row['Role'] . "</td>";
                            echo "<td>";
                            echo "<form method='POST' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>
                                <input type='hidden' name='delete_admin_id' value='" . $row['Admin_id'] . "'>
                                <button type='submit' class='btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</button>
                                </form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card">
            <div class="card-header"><b>USERS</b></div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row2 = mysqli_fetch_array($users_result)) {
                            echo "<tr>";
                            echo "<td>" . $row2['User_id'] . "</td>";
                            echo "<td>" . $row2['F_Name'] . "</td>";
                            echo "<td>" . $row2['L_Name'] . "</td>";
                            echo "<td>" . $row2['Email'] . "</td>";
                            echo "<td>" . $row2['Pass'] . "</td>";
                            echo "<td>" . $row2['Role'] . "</td>";
                            echo "<td>";
                            echo "<form method='POST' action='" . htmlspecialchars($_SERVER['PHP_SELF']) . "'>
                                <input type='hidden' name='delete_user_id' value='" . $row2['User_id'] . "'>
                                <button type='submit' class='btn-delete' onclick='return confirm(\"Are you sure?\")'>Delete</button>
                                </form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addusermodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header bg-dark">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User/Admin </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">

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

                        <div class="mb-3">

                            <select name="role" class="form-control">
                                <option selected disabled>Chose role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="add" class="btn btn-primary w-100">ADD</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>