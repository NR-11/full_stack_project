<nav class="navbar navbar-expand-lg fixed-top ">

    <div class="logo-container">
        <img src="images/logo.png">
        <h3>INSIDER</h3>
    </div>

    <form class="form" method="GET" action="home.php">
        <input class="form-control" name="search" type="search" placeholder="Search" name="search" value="">
        <button id="button" class="btn btn-outline-light mb-0" type="submit">Search</button>
    </form>

    <ul class="navbar-nav ms-auto">
        <li class="nav-item">
            <a class="nav-link" href="About.php">About Us</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Category</a>
            <ul class="dropdown-menu bg-dark">
                <li>
                    <form method="GET" action="home.php">
                <li><a class="dropdown-item text-white" href="?category=">All Articles</a></li>
                <li><a class="dropdown-item text-white" href="?category=1">Political News</a></li>
                <li><a class="dropdown-item text-white" href="?category=2">Sports News</a></li>
                <li><a class="dropdown-item text-white" href="?category=3">Economic News</a></li>
                <li><a class="dropdown-item text-white" href="?category=4">Technology News</a></li>
                </form>
        </li>
    </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="profile.php">Profile</a>
    </li>
    </ul>

</nav>