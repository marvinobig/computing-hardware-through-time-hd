<nav>
    <a href="/">CHTT</a>
    <section>
        <a href="/contributions.php">Contributions</a>
        <div>
            <?php if (!isset($_SESSION['user'])): ?>
                <a href="/login.php">Login</a>
                <a href="/register.php">Register</a>
            <?php else: ?>
                <a href="/admin/dashboard.php">Dashboard</a>
            <?php endif; ?>
        </div>
    </section>
</nav>