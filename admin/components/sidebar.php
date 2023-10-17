<div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom"><i class="fas fa-user-secret me-2"></i>The Book Nook</div>
    <div class="list-group list-group-flush my-3">
        <a href="<?= $baseUrl ?>dashboard.php" class="list-group-item list-group-item-action bg-transparent second-text <?= $page == 'dashboard.php' ? 'active' : '' ?>"><i class="fas fa-tachometer-alt me-2"></i>Dashboard</a>
        <a href="<?= $baseUrl ?>show-users.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= $page == 'show-users.php' || $page == 'edit-user.php' ? 'active' : '' ?>"><i class="fa-solid fa-user me-2"></i>Users</a>
        <a href="<?= $baseUrl ?>users/add-user.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= $page == 'add-user.php' ? 'active' : '' ?>"><i class="fa-solid fa-plus me-2"></i>Add User</a>
        <a href="<?= $baseUrl ?>show-books.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= $page == 'show-books.php' || $page == 'update-book.php' ? 'active' : '' ?>"><i class="fa-solid fa-book me-2"></i>Books</a>
        <a href="<?= $baseUrl ?>books/add-book.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= $page == 'add-book.php' ? 'active' : '' ?>"><i class="fa-solid fa-plus me-2"></i>Add New Book</a>
        <a href="<?= $baseUrl ?>show-genres.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= $page == 'show-genres.php' || $page == 'update-genre.php' ? 'active' : '' ?>"><i class="fas fa-project-diagram me-2"></i> Genres</a>
        <a href="<?= $baseUrl ?>genres/add-genre.php" class="list-group-item list-group-item-action bg-transparent second-text fw-bold <?= $page == 'add-genre.php' ? 'active' : '' ?>"><i class="fa-solid fa-plus me-2"></i>Add New Genre</a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold"><i class="fas fa-shopping-cart me-2 <?= $page == '' ? 'active' : '' ?>"></i>Orders</a>
        <a href="#" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold"><i class="fas fa-power-off me-2"></i>Logout</a>
    </div>
</div>