<?php
require 'medewerker_check.php';
require 'db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: gebruikers_overzicht.php');
    exit;
}

$stmt = $conn->prepare("SELECT users.*, adres.street, adres.housenumber, adres.zipcode, adres.city, adres.country, adres.phone
 FROM users LEFT JOIN adres ON adres.user_id = users.id WHERE users.id = :user_id");
$stmt->execute(['user_id' => $_GET['id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header('Location: gebruikers_overzicht.php');
    exit;
}

$paginatitel = $user['firstname'];
include 'header.php';
?>

<h1><?php echo htmlspecialchars($user['firstname']); ?> <?php echo htmlspecialchars($user['lastname']); ?></h1>

<p><strong>E-mailadres:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
<p><strong>Gebruikersnaam:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
<p><strong>Rol:</strong> <?php echo htmlspecialchars($user['rol']); ?></p>
<?php if(!empty($user['member_number'])): ?>
    <p><strong>Lidnummer:</strong> <?php echo htmlspecialchars($user['member_number']); ?></p>
<?php endif; ?>
<?php if(!empty($user['last_login_date'])): ?>
    <p><strong>Laatste login:</strong> <?php echo htmlspecialchars($user['last_login_date']); ?></p>
<?php endif; ?>

<?php if(!empty($user['street'])): ?>
    <h2>Adresgegevens</h2>
    <p><strong>Straat:</strong> <?php echo htmlspecialchars($user['street']); ?> <?php echo htmlspecialchars($user['housenumber']); ?></p>
    <p><strong>Postcode:</strong> <?php echo htmlspecialchars($user['zipcode']); ?></p>
    <p><strong>Woonplaats:</strong> <?php echo htmlspecialchars($user['city']); ?></p>
    <p><strong>Land:</strong> <?php echo htmlspecialchars($user['country']); ?></p>
    <p><strong>Telefoon:</strong> <?php echo htmlspecialchars($user['phone']); ?></p>
<?php endif; ?>

<a href="gebruikers_overzicht.php" class="terug">&larr; Terug naar leden</a>

<?php include 'footer.php'; ?>
