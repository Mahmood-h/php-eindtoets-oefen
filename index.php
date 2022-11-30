<?php

$db = new PDO("mysql:host=localhost;dbname=test",
    "root", "");
$query = $db->prepare("SELECT * FROM leerlingen");
$query->execute();
$leerlingen = $query->fetchAll(PDO::FETCH_ASSOC);
$teller = 1;
echo "<table>";
echo "<tr>";
echo "<td> Nummer </td>";
echo "<td> Leerling </td>";
echo "<td> Vak </td>";
echo "<td> Cijfer </td>";
echo "</tr>";
foreach ($leerlingen as $leerling) {

    echo "<tr>";
    echo "<td>" . $teller . "</td>";
    echo "<td>" . $leerling['leerling'] . "</td>";
    echo "<td>" . $leerling['vak'] . "</td>";
    echo "<td>" . $leerling['cijfer'] . "</td>";
    echo "<td> <a href='update.php?id=". $leerling["id"]."'>Update</a>";
    echo "<td> <a href='delete.php?id=". $leerling["id"]."'>Delete</a>";
    echo "</tr>";
    $teller++;
}
echo "</table>"
?>
<a href="insert.php">Insert</a>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }


</style>
</html>
