<?php
try {
    $db= new PDO("mysql:host=localhost;dbname=test",
    "root", "");

    if (isset($_POST['submit'])){
        $naam= filter_input(INPUT_POST, 'naam', FILTER_SANITIZE_STRING);
        $vak= filter_input(INPUT_POST, 'vak', FILTER_SANITIZE_STRING);
        $cijfer= filter_input(INPUT_POST, 'cijfer', FILTER_SANITIZE_NUMBER_FLOAT);

        $query=$db->prepare("INSERT INTO leerlingen(leerling, vak, cijfer) VALUES (:leerling, :vak, :cijfer)");

        $query->bindParam("naam", $naam);
        $query->bindParam("vak", $vak);
        $query->bindParam("cijfer", $cijfer);
        if ($query->execute()){
            header("Location: index.php");
        } else{
            echo "Er is een fout opgetreden";
        }
        echo "<br>";
    }
} catch (PDOException $e){
    die("Error!:" .$e->getMessage());
}
?>

<form method="post">

</form>
<form method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Leerling</label>
        <input type="text" name="naam"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Vak</label>
        <input type="text" name="vak"  class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Cijfer</label>
        <input type="text" name="cijfer"  class="form-control" id="exampleInputPassword1">
    </div>


    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>