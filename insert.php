<?php
try{
    $db=new PDO("mysql:host=localhost;dbname=cijfersysteem",
    "root", "");
    if (isset($_POST['submit'])) {
        if (!empty($_POST['leerling']) && !empty($_POST['vak']) && !empty($_POST['cijfer']) && !empty(['woonplaats'])) {
            $leerling = filter_input(INPUT_POST, 'leerling', FILTER_SANITIZE_STRING);
            $vak = filter_input(INPUT_POST, 'vak', FILTER_SANITIZE_STRING);
            $cijfer = filter_input(INPUT_POST, 'cijfer', FILTER_VALIDATE_FLOAT);
            $leeftijd = filter_input(INPUT_POST, 'leeftijd', FILTER_VALIDATE_FLOAT);
            $woonplaats = filter_input(INPUT_POST, 'woonplaats', FILTER_SANITIZE_STRING);

            if ($cijfer === false || $cijfer <= 1 || $cijfer > 10) {
                echo "Vul een getal tussen de 1 en 10 in";
            } else {
                $query = $db->prepare("INSERT INTO leerlingen(leerling, vak, cijfer, woonplaats, leeftijd) VALUES (:leerling, :vak, :cijfer,:woonplaats, :leeftijd)");
                $query->bindParam("leerling", $leerling);
                $query->bindParam("leeftijd", $leeftijd);
                $query->bindParam("vak", $vak);
                $query->bindParam("cijfer", $cijfer);
                $query->bindParam("woonplaats", $woonplaats);
                $query->execute();
                if ($query->execute()) {
                    header("Location: index.php");
                } else {
                    echo "Er is een fout opgetreden";
                }
                echo "<br>";

            }
        }
    }
} catch (PDOException $e){
    die("!Error:". $e->getMessage());
}

?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<form method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Leerling</label>
        <input type="text" name="leerling"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>  <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Leeftijd</label>
        <input type="text" name="leeftijd"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Vak</label>
        <input type="text" name="vak"  class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Cijfer</label>
        <input type="number" name="cijfer"  class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Woonplaats</label>
        <input type="text" name="woonplaats"  class="form-control" id="exampleInputPassword1">
    </div>



    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>