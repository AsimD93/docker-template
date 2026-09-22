<?php
require 'medewerker_check.php';
require 'db.php';

$terug = "<br/><a href='workout_create.php'>Terug</a>";

if(empty($_POST['title'])){
    echo "Titel is verplicht" . $terug;
    exit;
}

if(strlen($_POST['title']) < 3 || strlen($_POST['title']) > 100){
    echo "Titel moet tussen 3 en 100 karakters lang zijn" . $terug;
    exit;
}

if(empty($_POST['description'])){
    echo "Beschrijving is verplicht" . $terug;
    exit;
}

if(empty($_POST['duration'])){
    echo "Duur is verplicht" . $terug;
    exit;
}

if(!is_numeric($_POST['duration'])){
    echo "Duur moet een getal zijn" . $terug;
    exit;
}

if($_POST['duration'] <= 0){
    echo "Duur moet groter dan 0 zijn" . $terug;
    exit;
}

if(empty($_POST['type_id']) || !is_numeric($_POST['type_id'])){
    echo "Kies een type workout" . $terug;
    exit;
}

$stmt = $conn->prepare("SELECT id FROM types WHERE id = :id");
$stmt->execute(['id' => $_POST['type_id']]);
if(!$stmt->fetch()){
    echo "Dit type bestaat niet" . $terug;
    exit;
}

$stmt = $conn->prepare("SELECT id FROM workouts WHERE title = :title");
$stmt->execute(['title' => $_POST['title']]);
if($stmt->fetch()){
    echo "Er bestaat al een workout met deze titel" . $terug;
    exit;
}

$stmt = $conn->prepare("INSERT INTO workouts (title, description, duration, note, type_id) VALUES (:title, :description, :duration, :note, :type_id)");
$stmt->execute([
    'title' => $_POST['title'],
    'description' => $_POST['description'],
    'duration' => $_POST['duration'],
    'note' => $_POST['note'],
    'type_id' => $_POST['type_id']
]);

header("location: workouts_overzicht.php");
exit;
