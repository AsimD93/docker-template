<?php
require 'session_check.php';

if($_SESSION['rol'] != 'Medewerker'){
    echo "Je hebt geen toegang tot deze pagina.";
    echo "<br/><a href='dashboard.php'>Terug naar dashboard</a>";
    exit;
}
