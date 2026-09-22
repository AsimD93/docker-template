<?php
session_start();
require 'db.php';

$zoek = isset($_GET['zoek']) ? $_GET['zoek'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : '';

$query = "SELECT workouts.*, types.name AS type_name FROM workouts JOIN types ON types.id = workouts.type_id WHERE workouts.title LIKE :zoek";
$params = ['zoek' => "%$zoek%"];

if (is_numeric($type)) {
    $query .= " AND workouts.type_id = :type";
    $params['type'] = $type;
}
$query .= " ORDER BY workouts.title";

$stmt = $conn->prepare($query);
$stmt->execute($params);
$workouts = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM types ORDER BY id");
$stmt->execute();
$types = $stmt->fetchAll(PDO::FETCH_ASSOC);

$paginatitel = "Workouts";
include 'header.php';
?>

<div class="intro">
    <h1>Onze workouts</h1>
    <p>Van hardlopen tot gewichtheffen: bekijk ons aanbod en vind een workout die bij je past.</p>
</div>

<form action="index.php" method="get" class="zoekbalk">
    <input type="text" name="zoek" placeholder="Zoek op naam" value="<?php echo htmlspecialchars($zoek); ?>">
    <select name="type">
        <option value="">Alle types</option>
        <?php foreach ($types as $t): ?>
            <option value="<?php echo $t['id']; ?>" <?php if($type == $t['id']) echo 'selected'; ?>><?php echo htmlspecialchars($t['name']); ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Zoeken</button>
</form>

<?php if(count($workouts) == 0): ?>
    <p class="melding">Geen workouts gevonden.</p>
<?php endif; ?>

<div class="grid">
    <?php foreach ($workouts as $workout): ?>
        <div class="card">
            <img src="images/<?php echo htmlspecialchars($workout['title']); ?>.jpg" alt="<?php echo htmlspecialchars($workout['title']); ?>">
            <div class="card-info">
                <p class="titel"><?php echo htmlspecialchars($workout['title']); ?></p>
                <p><?php echo htmlspecialchars($workout['type_name']); ?> &middot; <?php echo $workout['duration']; ?> min</p>
                <a href="detail.php?id=<?php echo $workout['id']; ?>" class="knop">Bekijk details</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<?php include 'footer.php'; ?>
