<?php
include('config.php');
//  if (!empty($_POST['code'])) {
//        $code = $_POST['code'];
//      $sql = "SELECT * FROM etudiant where CodeEtudiant=$code";
//       $query = $pdo->prepare($sql);
//       $query->execute();
//       $result = $query->fetchAll(PDO::FETCH_ASSOC) ;//fetch_assoc:pour ne pas repeter la meme colonne
//      $req = $pdo->query($sql);
//      $res = $req->fetchAll(); 
//  }

if (!empty($_POST['btn'])) {
    $choix = $_POST['choix'];
    // $code = $_POST['code'];
    $searvalue = $_POST['search'];
    $stmt = $pdo->prepare("SELECT * FROM etudiant WHERE {$choix}=?");
    $stmt->execute(array($searvalue));

    /*  if (!($res = $stmt->fetch())) {


        echo "<div class='alert alert-danger'>
        <strong>Danger!</strong> 'Ce code n'existe pas '
      </div>";
    } */
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Recherche</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            padding: 10px;
        }

        table {
            margin-top: 20px;
            text-align: center;
        }

        h1 {
            text-align: center;
            font-family: cursive;
            text-decoration: underline
        }

        body {
            background-color: #eee;
            font-family: cursive;
        }

        a {
            margin-bottom: 12px;
        }
    </style>

</head>

<body class="container">

    <form method="POST">
        <!-- <label for="cc">Code</label>
        <input type="number" name="code" id="cc"> -->

        <!-- <div class="form-group">
            <label for="name">Code:</label>
            <input type="number" class="form-control" name="code" id="code"  required>
        </div> -->

        <select name="choix">
            <option value="CodeEtudiant" selected>Code</option>
            <option value="class">Classe</option>

        </select>
        <input type="text" name="search" class="form-control">

        <center>
            <input type="submit" name="btn" value="search">
        </center>
    </form>
    <main>
        <section>
            <h1>Liste d'etudiant</h1>
            <table class="table table-striped">
                <thead>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Adresse</th>
                    <th>Classe</th>
                </thead>
        </section>
        <tbody>
            <?php
            if (!empty($_POST['choix'])) {
                if (!($res = $stmt->fetch())) {


                    echo "<div class='alert alert-danger'>
                    <strong>Danger!</strong> 'Ce code n'existe pas '
                  </div>";
                } else {
            ?>
                    <tr>
                        <td><?php echo $res["CodeEtudiant"] ?></td>
                        <td><?php echo $res["nom"] ?></td>
                        <td><?php echo $res["prenom"] ?></td>
                        <td><?php echo $res["adresse"] ?></td>
                        <td><?php echo $res["class"] ?></td>


                    </tr>

            <?php
                }
            }
            ?>
        </tbody>
        </table>

        <center>
            <h2><a href="nouveauEtudiant.php">Ajouter des etudiant</a></h2>
            <h2><a href="update.php">Modifier des etudiant</a></h2>
        </center>
    </main>

</body>

</html>