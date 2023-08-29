<?php
session_start();
if (isset($_POST['code'])) {
    $code = $_POST["code"];

    include("config.php");
    $verify = $pdo->prepare("SELECT * FROM etudiant WHERE CodeEtudiant = :codeE limit 1");
    $verify->bindValue(":codeE", $code);
    $verify->execute();
    $user = $verify->fetchAll();
    if (count($user) > 0) {
        $etu = $pdo->prepare("DELETE FROM etudiant
            WHERE CodeEtudiant = :codeE;");
        $etu->bindValue(":codeE", $code);
        if ($etu->execute()) {
?>
            <script>
                alert("Supprimer succès");
            </script>
<?php
            header("location: list.php");
        }
    } else {
        $erreur = "Ce code n'existe pas de base!";
    }
}
?>