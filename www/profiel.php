<?php
require 'session_check.php';
require 'db.php';

$stmt = $conn->prepare("SELECT users.*, adres.street, adres.housenumber, adres.zipcode, adres.city, adres.country, adres.phone 
FROM users LEFT JOIN adres ON adres.user_id = users.id WHERE users.id = :user_id");
$stmt->execute(['user_id' => $_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$paginatitel = "Mijn profiel";
include 'header.php';
?>

<h1>Mijn profiel</h1>

<p><strong>Voornaam:</strong> <?php echo htmlspecialchars($user['firstname']); ?></p>
<p><strong>Achternaam:</strong> <?php echo htmlspecialchars($user['lastname']); ?></p>
<p><strong>E-mailadres:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
<p><strong>Gebruikersnaam:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
<p><strong>Rol:</strong> <?php echo htmlspecialchars($user['rol']); ?></p>
<?php if(!empty($user['member_number'])): ?>
    <p><strong>Lidnummer:</strong> <?php echo htmlspecialchars($user['member_number']); ?></p>
<?php endif; ?>

<?php if(!empty($user['street'])): ?>
    <h2>Adresgegevens</h2>
    <p><strong>Straat:</strong> <?php echo htmlspecialchars($user['street']); ?> <?php echo htmlspecialchars($user['housenumber']); ?></p>
    <p><strong>Postcode:</strong> <?php echo htmlspecialchars($user['zipcode']); ?></p>
    <p><strong>Woonplaats:</strong> <?php echo htmlspecialchars($user['city']); ?></p>
    <p><strong>Land:</strong> <?php echo htmlspecialchars($user['country']); ?></p>
    <p><strong>Telefoon:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
<?php endif; ?>

<?php include 'footer.php'; ?>
