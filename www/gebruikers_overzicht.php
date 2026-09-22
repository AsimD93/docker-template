<?php
require 'medewerker_check.php';
require 'db.php';

$zoek = isset($_GET['zoek']) ? $_GET['zoek'] : '';

$stmt = $conn->prepare("SELECT * FROM users WHERE rol = :rol AND (firstname LIKE :zoek1 OR lastname LIKE :zoek2
 OR email LIKE :zoek3) ORDER BY lastname");
$stmt->execute(['rol' => 'Lid', 'zoek1' => "%$zoek%", 'zoek2' => "%$zoek%", 'zoek3' => "%$zoek%"]);
$leden = $stmt->fetchAll(PDO::FETCH_ASSOC);

$paginatitel = "Leden";
include 'header.php';
?>

<h1>Alle leden</h1>

<form action="gebruikers_overzicht.php" method="get" class="zoekbalk">
    <input type="text" name="zoek" placeholder="Zoek op naam of e-mailadres" value="<?php echo htmlspecialchars($zoek); ?>">
    <button type="submit">Zoeken</button>
</form>

<div class="tabel-wrap">
    <table class="tabel">
        <thead>
            <tr>
                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Lidnummer</th>
                <th>Actie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($leden as $lid): ?>
            <tr>
                <td><?php echo htmlspecialchars($lid['firstname']); ?></td>
                <td><?php echo htmlspecialchars($lid['lastname']); ?></td>
                <td><?php echo htmlspecialchars($lid['member_number']); ?></td>
                <td><a href="gebruiker_detail.php?id=<?php echo $lid['id']; ?>">Bekijk</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php if(count($leden) == 0): ?>
    <p class="melding">Geen leden gevonden.</p>
<?php endif; ?>

<?php include 'footer.php'; ?>
