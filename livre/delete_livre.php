<?php
session_start();
if (isset($_POST['code'])) {
    $code = $_POST["code"];

    include("config.php");
    $verify = $pdo->prepare("SELECT * FROM livre WHERE CodeLivre = :codeE limit 1");
    $verify->bindValue(":codeE", $code);
    $verify->execute();
    $user = $verify->fetchAll();
    if (count($user) > 0) {
        $etu = $pdo->prepare("DELETE FROM livre
            WHERE CodeLivre = :codeE;");
        $etu->bindValue(":codeE", $code);
        if ($etu->execute()) {
?>
            <script>
                alert("Supprimer succès");
            </script>
<?php
            header("location: liste_livre.php");
        }
    } else {
        $erreur = "Ce code n'existe pas de base!";
    }
}
?>