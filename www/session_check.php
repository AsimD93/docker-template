<?php
session_start();

if(empty($_SESSION['user_id'])){
    echo "Je bent niet ingelogd.";
    echo "<br/><a href='login.php'>Login hier in</a>";
    exit;
}
