<?php
session_start();
if (isset($_POST['code'])) {
    $code = $_POST["code"];
    $titre = $_POST["titre"];
    $auteur = $_POST["auteur"];
    $date = $_POST["DateEdition"];
    $valider = $_POST["btn"];
    $erreur = "";
    if (isset($valider)) {
        include("config.php");

        $etu = $pdo->prepare("UPDATE livre
            SET titre = :titre, auteur = :auteur, DateEdition = :DateEdition
            WHERE CodeLivre = :codeE;");
        $etu->bindValue(":codeE", $code);
        $etu->bindValue(":titre", $titre);
        $etu->bindValue(":auteur", $auteur);
        $etu->bindValue(":DateEdition", $date);
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
            <label for="titre">titre : </label>
            <br>
            <input type="text" name="titre" placeholder="saisie votre Nom" class="form-control" value="<?php if (isset($_POST['titre'])) {
                                                                                                            echo $_POST['titre'];
                                                                                                        } ?>"><br>
            <label for="auteur"> auteur</label>
            <br>
            <input type="text" name="auteur" placeholder="saisie votre Prenom" class="form-control" value="<?php if (isset($_POST['auteur'])) {
                                                                                                                echo $_POST['auteur'];
                                                                                                            } ?>"><br>
            <label for="DateEtudiant">DateEtudiant</label>
            <br>
            <input type="text" name="DateEtudiant" placeholder="saisie votre Class" class="form-control" value="<?php if (isset($_POST['DateEtudiant'])) {
                                                                                                                echo $_POST['DateEtudiant'];
                                                                                                            } ?>"><br>
                                                                                                                        
            <input type="submit" name="btn" id="sub" class="btn btn-success" value="create">
            <button type="submit" class="btn btn-primary"><a href="liste_livre.php">Go to list</a></button>

        </form>
    </center>
</body>

</html>