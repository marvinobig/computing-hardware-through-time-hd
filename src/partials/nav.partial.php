<nav>
    <div id="inner-nav">
        <a id="site-title" href="/">CHTT</a>
        <section>
            <a href="/contributions.php">Contributions</a>
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="/admin/auth/login.php">Login</a>
            <?php else: ?>
                <a href="/admin/dashboard.php">Dashboard</a>
                <a id="logout" href="/api/logout.php">Logout</a>
            <?php endif; ?>
        </section>
    </div>
</nav>