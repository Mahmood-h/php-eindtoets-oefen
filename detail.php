<?php
try{
    $db= new PDO("mysql:host=localhost;dbname=cijfersysteem",
    "root", "");

    $query= $db->prepare("SELECT * FROM `leerlingen` WHERE id=".$_GET['id']);
    $query->execute();
    $result=$query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $data){
        echo "Naam:" .$data['leerling']. "<br>";
        echo "Leeftijd:" .$data['leeftijd']. "<br>";
        echo "Woonplaats:" .$data['woonplaats']. "<br>";
    }

} catch (PDOException $e){
    die("Error!:". $e->getMessage());
}
?>
<a href="index.php">Terug naar overzicht</a>
