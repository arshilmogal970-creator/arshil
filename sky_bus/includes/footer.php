<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?php echo APP_URL; ?>/index.php"><i class="bi bi-bus-front-fill"></i> SKY BUS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item"><a class="nav-link" href="<?php echo APP_URL; ?>/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo APP_URL; ?>/about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo APP_URL; ?>/contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="<?php echo APP_URL; ?>/search-booking.php">Track Booking</a></li>
                <?php if (isLoggedIn()): ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo APP_URL; ?>/user/my-bookings.php">My Bookings</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo APP_URL; ?>/user/profile.php">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo APP_URL; ?>/auth/logout.php">Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?php echo APP_URL; ?>/auth/login.php">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?php echo APP_URL; ?>/auth/register.php">Register</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="btn btn-light ms-lg-3" href="<?php echo APP_URL; ?>/admin/login.php">Admin</a></li>
            </ul>
        </div>
    </div>
</nav>
