<?php include('config.php'); ?>

<?php
$search = $_GET['search'] ?? null;
$attribute = $_GET['attribute'] ?? 'code';
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>list</title>
    <style>
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

<body>


    <div class="container">
        <h1>list for etudient</h1>
        <a href="nouveauEtudiant.php" class="btn btn-success" id="a">Create New etudient</a>
        <form method="GET">
            <div>
                critère:
                <select name="attribute" class="form-select" aria-label="Default select example">
                    <option <?php if ($attribute === "CodeEtudiant") : ?> selected <?php endif; ?> value="code">Code</option>
                    <option <?php if ($attribute === "nom") : ?> selected <?php endif; ?> value="nom">Nom</option>
                    <option <?php if ($attribute === "prenom") : ?> selected <?php endif; ?> value="prenom">Prenom</option>
                    <option <?php if ($attribute === "class") : ?> selected <?php endif; ?> value="classe">CLasse</option>
                    <option <?php if ($attribute === "adresse") : ?> selected <?php endif; ?> value="adresse">Adresse</option>
                </select>
            </div>
            <br>

            <div class="input-group mb-3">
                <!-- <input type="text" class="form-control" placeholder="search" name="search" value="<?php echo $search ?>" />
                <button class="btn btn-outline-secondary" type="submit">Search</button> -->
            </div>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#code</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prenom</th>
                    <th scope="col">Classe</th>
                    <th scope="col">Adresse</th>
                    <th scope="col">Option</th>
                </tr>
            </thead>
            <tbody>

                <?php
                if ($search) {

                    $statement = $pdo->prepare("SELECT * FROM etudiant WHERE $attribute like :search ORDER BY CodeEtudiant");
                    $statement->bindValue(':search', "%$search%");
                } else {
                    $statement = $pdo->prepare("SELECT * FROM etudiant ORDER BY CodeEtudiant");

                    if ($statement->execute()) {
                        // $member = $statement->fetchAll();

                ?>
                        <?php /* foreach */ while ($statements = $statement->fetch()) {  ?>
                            <tr>
                                <th scope="row"><?php echo $statements['CodeEtudiant'] ?></th>
                                <td> <?php echo $statements['nom'] ?></td>
                                <td> <?php echo $statements['prenom'] ?></td>
                                <td> <?php echo $statements['class'] ?></td>
                                <td> <?php echo $statements['adresse'] ?></td>
                                <td>
                                    <a href="update.php?code=<?php echo $statements['CodeEtudiant'] ?>" class="btn btn-sm btn-outline-primary">Update</a>
                                    <form style="display: inline-block" method="post" action="delete.php">
                                        <input type="hidden" name="code" value="<?php echo $statements['CodeEtudiant'] ?>" />
                                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                <?php }
                    }
                } ?>
            </tbody>
        </table>
    </div>
    <div style="width: 100px;margin:20px auto;">
        <a href="search.php">Search</a>
    </div>
</body>

</html>