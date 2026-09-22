<?php
require 'medewerker_check.php';
require 'db.php';

$stmt = $conn->prepare("SELECT workouts.*, types.name AS type_name FROM workouts JOIN types ON types.id = workouts.type_id ORDER BY workouts.title");
$stmt->execute();
$workouts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$paginatitel = "Beheer workouts";
include 'header.php';
?>

<h1>Alle workouts</h1>
<p><a href="workout_create.php" class="knop">Nieuwe workout</a></p>

<div class="tabel-wrap">
    <table class="tabel">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titel</th>
                <th>Type</th>
                <th>Duur</th>
                <th>Toegevoegd op</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($workouts as $workout): ?>
            <tr>
                <td><?php echo $workout['id']; ?></td>
                <td><?php echo htmlspecialchars($workout['title']); ?></td>
                <td><?php echo htmlspecialchars($workout['type_name']); ?></td>
                <td><?php echo $workout['duration']; ?> min</td>
                <td><?php echo $workout['added_at']; ?></td>
                <td><a href="detail.php?id=<?php echo $workout['id']; ?>">Bekijk</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
