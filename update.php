<?php
if (isset($_POST['submit'])){
    if (!empty($_POST['vak']) && !empty($_POST['cijfer']) ){
        $vak=filter_input(INPUT_POST, 'vak', FILTER_SANITIZE_STRING);
        $cijfer=filter_input(INPUT_POST, 'cijfer', FILTER_VALIDATE_FLOAT);

        if ($cijfer ===false || $cijfer<=1 || $cijfer >10){
            echo "Vul een getal tussen 1 en 10 in";
        } else{
            $db= new PDO("mysql:host=localhost;dbname=cijfersysteem",
                "root", "");
                $query= $db->prepare("UPDATE leerlingen SET vak=:vak, cijfer=:cijfer WHERE id=".$_GET['id']);
            $query->bindParam("vak", $vak);
            $query->bindParam("cijfer", $cijfer);
            $query->execute();
            header("Location:index.php");


        }
    } else{
        $bericht="Vul alles in";
    }
}
    $db= new PDO("mysql:host=localhost;dbname=cijfersysteem",
        "root", "");
    $query= $db->prepare("SELECT * FROM leerlingen WHERE id=:id");
    $query->bindParam("id", $_GET['id']);
    $query->execute();
    $result=$query->fetch(PDO::FETCH_ASSOC);


    $vak=$result['vak'];
    $cijfer=$result['cijfer'];








?>

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<form method="post">

</form>
<form method="post">
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Leerling</label>
        <input type="text" name="leerling" disabled="disabled"    value="<?php echo $result['leerling'];?>"   class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Vak</label>
        <input type="text" name="vak"  value="<?= $vak;?>"  class="form-control" id="exampleInputPassword1">
    </div>
    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Cijfer</label>
        <input type="text" name="cijfer" value="<?php echo $cijfer?>"  class="form-control" id="exampleInputPassword1">
    </div>


    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</form>
