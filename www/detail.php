<?php
session_start();
require 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$stmt = $conn->prepare("SELECT workouts.*, types.name AS type_name FROM workouts JOIN types ON 
types.id = workouts.type_id WHERE workouts.id = :id");
$stmt->execute(['id' => $_GET['id']]);
$workout = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$workout) {
    header('Location: index.php');
    exit;
}

$paginatitel = $workout['title'];
include 'header.php';
?>

<div class="detail">
    <img src="images/<?php echo htmlspecialchars($workout['title']); ?>.jpg" alt="<?php echo htmlspecialchars($workout['title']); ?>">

    <div class="detail-info">
        <h1><?php echo htmlspecialchars($workout['title']); ?></h1>
        <p><strong>Type:</strong> <?php echo htmlspecialchars($workout['type_name']); ?></p>
        <p><strong>Duur:</strong> <?php echo $workout['duration']; ?> minuten</p>
        <p><strong>Beschrijving:</strong> <?php echo htmlspecialchars($workout['description']); ?></p>
        <p><strong>Notitie:</strong> <?php echo htmlspecialchars($workout['note']); ?></p>

        <a href="index.php" class="terug">&larr; Terug naar overzicht</a>
    </div>
</div>

<?php include 'footer.php'; ?>
