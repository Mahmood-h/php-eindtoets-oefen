<?php
$db= new PDO("mysql:host=localhost;dbname=cijfersysteem",
    "root", "");
if (isset($_GET['id'])){
    $id=filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
    $query= $db->prepare("DELETE FROM leerlingen WHERE id=:id");
    $query->bindParam("id", $id);
    $query->execute();
    header("Location:index.php");
}
?>