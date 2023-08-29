<?php
session_start();
if (isset($_POST['code'])) {
    $code = $_POST["code"];
    $nome = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $adresse = $_POST["adresse"];
    $valider = $_POST["btn"];
    $erreur = "";
    if (isset($valider)) {
        include("config.php");

        $etu = $pdo->prepare("UPDATE etudiant
            SET prenom = :prenom, nom = :nome, class = :adresse
            WHERE CodeEtudiant = :codeE;");
        $etu->bindValue(":codeE", $code);
        $etu->bindValue(":nome", $nome);
        $etu->bindValue(":prenom", $prenom);
        $etu->bindValue(":adresse", $adresse);
    }
    if ($etu->execute()) {
?>
        <script>
            alert('Modification succès ');
        </script>
<?php
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
        <h3>update etudiant</h3>
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