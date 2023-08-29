<?php require_once 'config.php' ?>
<?php
$code = '';
$titre = '';
$auteur = '';
$DateEdition = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code = $_POST['code'];
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $DateEdition = $_POST['date'];

    
    if (!$code or !$titre or !$auteur or !$DateEdition) {
        echo "Your forget some information.";
    } else {
        $sql = $pdo->prepare("SELECT CodeLivre FROM `livre` WHERE CodeLivre= :code");
        $sql->bindValue(':code', $code);
        $sql->execute();
        $count = $sql->rowCount();
        if ($count > 0) {
            ?>
            <script> alert('Code already exists'); </script>
            <?php
        } else {
            $query = $pdo->prepare("INSERT INTO `livre` (`CodeLivre`,`titre`,`auteur`,`DateEdition`) VALUES (:code,:titre,:auteur,:dateE)");
            $query->bindValue(':code', $code);
            $query->bindValue(':titre', $titre);
            $query->bindValue(':auteur', $auteur);
            $query->bindValue(':dateE', $DateEdition);
            $query->execute();
            ?>
            <script> alert('Create successfully'); </script> 
        <?php
            
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
        <h3>Create new livre</h3>
        <form action="" method="POST">
            <label for="code">code</label><br>
            <input type="text" name="code" placeholder="saisie votre code" class="form-control" value="<?php if (isset($_POST['code'])) {
                                                                                                            echo $_POST['code'];
                                                                                                        } ?>"><br>
            <label for="titre">titre : </label>
            <br>
            <input type="text" name="titre" placeholder="saisie votre titre" class="form-control" value="<?php if (isset($_POST['titre'])) {
                                                                                                            echo $_POST['titre'];
                                                                                                        } ?>"><br>
            <label for="auteur"> auteur:</label>
            <br>
            <input type="text" name="auteur" placeholder="saisie votre auteur" class="form-control" value="<?php if (isset($_POST['auteur'])) {
                                                                                                                echo $_POST['auteur'];
                                                                                                            } ?>"><br>
            <label for="date"> DateEdition</label>
            <br>
            <input type="text" name="date" placeholder="saisie votre DateEdition" class="form-control" value="<?php if (isset($_POST['date'])) {
                                                                                                                echo $_POST['date'];
                                                                                                            } ?>"><br>

            <input type="submit" name="btn" id="sub" class="btn btn-success" value="create">
            <button type="submit" class="btn btn-primary"><a href="liste_livre.php">Go to list</a></button>

        </form>
    </center>
</body>

</html>