<nav>
    <a href="/">CHTT</a>
    <section>
        <a href="/contributions.php">Contributions</a>
        <div>
            <?php if (!isset($_SESSION['admin_user'])): ?>
                <a href="/admin/auth/login.php">Login</a>
            <?php else: ?>
                <a href="/admin/dashboard.php">Dashboard</a>
            <?php endif; ?>
        </div>
    </section>
</nav>