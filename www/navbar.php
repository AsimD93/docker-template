<nav class="navbar">
    <a href="index.php" class="nav-logo">Work4Me</a>
    <div class="nav-links">
        <a href="about.php">Over ons</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="dashboard.php">Dashboard</a>
            <a href="profiel.php">Mijn profiel</a>
            <?php if($_SESSION['rol'] == 'Medewerker'): ?>
                <a href="workouts_overzicht.php">Beheer workouts</a>
                <a href="gebruikers_overzicht.php">Leden</a>
            <?php endif; ?>
            <a href="logout.php" class="nav-logout">Uitloggen</a>
        <?php else: ?>
            <a href="login.php">Inloggen</a>
        <?php endif; ?>
    </div>
</nav>
