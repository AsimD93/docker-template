<?php
require 'medewerker_check.php';
require 'db.php';

$stmt = $conn->prepare("SELECT * FROM types ORDER BY id");
$stmt->execute();
$types = $stmt->fetchAll(PDO::FETCH_ASSOC);

$paginatitel = "Nieuwe workout";
include 'header.php';
?>

<h1>Nieuwe workout</h1>

<form action="workout_create_process.php" method="post" class="formulier">
    <div class="veld">
        <label for="title">Titel *</label>
        <input type="text" name="title" id="title" placeholder="bijv. Yoga voor beginners">
    </div>
    <div class="veld">
        <label for="type_id">Type *</label>
        <select name="type_id" id="type_id">
            <option value="">Kies een type</option>
            <?php foreach ($types as $type): ?>
                <option value="<?php echo $type['id']; ?>"><?php echo htmlspecialchars($type['name']); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="veld">
        <label for="description">Beschrijving *</label>
        <input type="text" name="description" id="description">
    </div>
    <div class="veld">
        <label for="duration">Duur in minuten *</label>
        <input type="number" name="duration" id="duration" placeholder="bijv. 45">
    </div>
    <div class="veld">
        <label for="note">Notitie</label>
        <input type="text" name="note" id="note">
    </div>
    <button type="submit">Workout opslaan</button>
</form>

<?php include 'footer.php'; ?>
