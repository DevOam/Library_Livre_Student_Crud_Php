<?php require_once 'config.php' ?>
<?php
$code = '';
$nom = '';
$prenom = '';
$adresse = '';
$classe = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $adresse = $_POST['adresse'];
    $classe = $_POST['classe'];


    if (!$code or !$nom or !$prenom or !$adresse or !$classe) {
        echo "Your forget some information.";
    } else {
        $sql = $pdo->prepare("SELECT CodeEtudiant FROM `etudiant` WHERE CodeEtudiant=$code");
        $sql->execute();
        $count = $sql->rowCount();
        if ($count > 0) {
            echo "Code already exists ";
        } else {
            $query = $pdo->prepare("INSERT INTO `etudiant` (`CodeEtudiant`,`nom`,`prenom`,`adresse`,`class`)VALUES (:code,:nom,:prenom,:adresse,:classe)");
            $query->bindValue(':code', $code);
            $query->bindValue(':nom', $nom);
            $query->bindValue(':prenom', $prenom);
            $query->bindValue(':adresse', $adresse);
            $query->bindValue(':classe', $classe);
            $query->execute();
            echo "Create successfully";
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        form {
            border: 1px solid black;
            padding: 10px;
            width: 600px;
            background-color: #eee;
            border-radius: 10px;
        }

        a {
            text-decoration: none;
            color: white;
        }

        a:hover {
            color: white
        }
    </style>
</head>

<body>
    <center>
        <h3>Create new etudient</h3>
        <form action="" method="POST">
            <label for="">code</label><br>
            <input type="text" name="code" placeholder="saisie votre code" class="form-control" value="<?php if (isset($_POST['code'])) {
                                                                                                            echo $_POST['code'];
                                                                                                        } ?>"><br>
            <label for="">Nom : </label>
            <br>
            <input type="text" name="nom" placeholder="saisie votre Nom" class="form-control" value="<?php if (isset($_POST['nom'])) {
                                                                                                            echo $_POST['nom'];
                                                                                                        } ?>"><br>
            <label for=""> Prenom</label>
            <br>
            <input type="text" name="prenom" placeholder="saisie votre Prenom" class="form-control" value="<?php if (isset($_POST['prenom'])) {
                                                                                                                echo $_POST['prenom'];
                                                                                                            } ?>"><br>
            <label for=""> Classe</label>
            <br>
            <input type="text" name="classe" placeholder="saisie votre Class" class="form-control" value="<?php if (isset($_POST['classe'])) {
                                                                                                                echo $_POST['classe'];
                                                                                                            } ?>"><br>
            <label for="message"> Adresse</label> <br>
            <br>
            <textarea name="adresse" cols="10" rows="7" placeholder="saisie votre Adresse" class="form-control" value="<?php if (isset($_POST['adresse'])) {
                                                                                                                            echo $_POST['adresse'];
                                                                                                                        } ?>"> </textarea><br>
            <input type="submit" name="btn" id="sub" class="btn btn-success" value="create">
            <button type="submit" class="btn btn-primary"><a href="list.php">Go to list</a></button>

        </form>
    </center>
</body>

</html>