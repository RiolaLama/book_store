<div class="container-fluid bg-white sticky-top">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-2 py-lg-0">
            <a href="index.php" class="navbar-brand">
                <img class="img-fluid" src="assets/pictures/logo.png" alt="Logo">
            </a>
            <button type="button" class="navbar-toggler ms-auto me-0" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarCollapse">
                <div class="navbar-nav">
                    <a href="index.php" class="nav-item nav-link <?= $page == 'index.php' ? 'active' : '' ?>">Home</a>
                    <a href="about.php" class="nav-item nav-link <?= $page == 'about.php' ? 'active' : '' ?>">About</a>
                    <a href="books.php" class="nav-item nav-link <?= $page == 'books.php' || $page == 'details.php' ? 'active' : '' ?>">Books</a>
                    <a href="cart.php" class="nav-item nav-link <?= $page == 'cart.php' ? 'active' : '' ?>">Cart</a>
                    <a href="contact.php" class="nav-item nav-link <?= $page == 'contact.php' ? 'active' : '' ?>">Contact</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"> <img src="assets/img/<?= $user['profile_picture'] ?>" class="rounded-circle " width="40" height=30 alt="Profile picture" /></a>
                        <div class="dropdown-menu bg-light rounded-0 m-0 profile-img">
                            <a href="edit-profile.php" class="dropdown-item">My Profile</a>
                            <a href="logout.php?logout" class="dropdown-item">Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</div>