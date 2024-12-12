<nav>
    <a href="/">CHTT</a>
    <section>
        <a href="/contributions.php">Contributions</a>
        <div>
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="/admin/auth/login.php">Login</a>
            <?php else: ?>
                <a href="/admin/dashboard.php">Dashboard</a>
                <a href="/api/logout.php">Logout</a>
            <?php endif; ?>
        </div>
    </section>
</nav>