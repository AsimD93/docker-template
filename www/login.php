<?php
session_start();
$paginatitel = "Inloggen";
include 'header.php';
?>

<h1>Inloggen</h1>

<form action="login_process.php" method="post" class="formulier">
    <div class="veld">
        <label for="email">E-mailadres</label>
        <input type="text" name="email" id="email" placeholder="jouw@email.com">
    </div>
    <div class="veld">
        <label for="password">Wachtwoord</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit">Inloggen</button>
</form>

<?php include 'footer.php'; ?>
