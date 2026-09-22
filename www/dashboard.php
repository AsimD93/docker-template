<?php
require 'session_check.php';
require 'db.php';

$stmt = $conn->prepare("SELECT COUNT(*) AS totaal, AVG(duration) AS gemiddeld, MAX(duration) AS langste FROM workouts");
$stmt->execute();
$workoutstats = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT COUNT(*) AS totaal FROM users WHERE rol = :rol");
$stmt->execute(['rol' => 'Lid']);
$aantal_leden = $stmt->fetch(PDO::FETCH_ASSOC)['totaal'];

$paginatitel = "Dashboard";
include 'header.php';
?>

<h1>Dashboard</h1>
<p>Welkom terug, <?php echo htmlspecialchars($_SESSION['firstname']); ?>!</p>

<div class="stats">
    <div class="stat">
        <h3><?php echo $workoutstats['totaal']; ?></h3>
        <p>Workouts</p>
    </div>
    <div class="stat">
        <h3><?php echo round($workoutstats['gemiddeld']); ?> min</h3>
        <p>Gemiddelde duur</p>
    </div>
    <div class="stat">
        <h3><?php echo $workoutstats['langste']; ?> min</h3>
        <p>Langste workout</p>
    </div>
    <div class="stat">
        <h3><?php echo $aantal_leden; ?></h3>
        <p>Leden</p>
    </div>
</div>

<?php include 'footer.php'; ?>
