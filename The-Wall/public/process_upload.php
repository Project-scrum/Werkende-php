<?php
//echo 'Naam van de file: ' . $_FILES['uploaded_image'] ['name'] . '<br>';
//echo 'Grootte van de file in bytes: ' . $_FILES['uploaded_image'] ['size'] . '<br>';
//echo 'Tijdelijke opslaglocatie: ' . $_FILES['uploaded_image'] ['tmp_name'] . '<br>';

$temp_location = $_FILES ['uploaded_image'] ['tmp_name'];
$target_location = 'images/' . time() . $_FILES ['uploaded_image'] ['name'];

$images = array();

move_uploaded_file($temp_location, $target_location);


$title = $_POST['title'];
$description = $_POST['description'];
$tags = $_POST['tags'];
// array_push($images, $image);

$mysqli = new mysqli('localhost', 'root', 'root', 'the-wall') or die ('Error connecting');
$query = "INSERT INTO images VALUES (0,?,?,?,?)";
$stmt = $mysqli->prepare($query) or die ('Error preparing');
$stmt->bind_param('ssss', $target_location, $title, $description, $tags) or die ('Error bind param');
$stmt->execute() or die ('Error inserting image in database');
$stmt->close();

header('location: main.php');
header('location: post.php');
?>