

<?php
try {
    $db= new PDO("mysql:host=localhost;dbname=cijfersysteem",
        "root", "");

    if (isset($_POST['submit'])){

        $leerling= filter_input(INPUT_POST, 'leerling', FILTER_SANITIZE_STRING);
        $vak= filter_input(INPUT_POST, 'vak', FILTER_SANITIZE_STRING);
        $cijfer= filter_input(INPUT_POST, 'cijfer', FILTER_VALIDATE_FLOAT);
        if (!empty($leerling) && !empty($vak) && !empty($cijfer)){
            if ($cijfer ===false || $cijfer>=1 || $cijfer <=10){
                $query=$db->prepare("INSERT INTO leerlingen(leerling, vak, cijfer) VALUES (:leerling, :vak, :cijfer)");
                $query->bindParam("leerling", $leerling);
                $query->bindParam("vak", $vak);
                $query->bindParam("cijfer", $cijfer);
                if ($query->execute()){
                    header("Location: index.php");
                } else{
                    echo "Er is een fout opgetreden";
                }
                echo "<br>";
            }else{
                echo "Vul een getal tot 10 in!";
            }

        } else{
            echo "Vul alles in";
        }

        }



} catch (PDOException $e){
    die("Error!:" .$e->getMessage());
}
?>
<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<form method="post">

</form>
<form method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Leerling</label>
        <input type="text" name="leerling"  class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
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