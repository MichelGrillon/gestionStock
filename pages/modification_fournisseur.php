<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $fournisseurId = $_POST['id'];

    $societe = htmlspecialchars($_POST['societe']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $codePostal = htmlspecialchars($_POST['codePostal']);
    $ville = htmlspecialchars($_POST['ville']);
    $commentaire = htmlspecialchars($_POST['commentaire']);

    if (!empty($societe) && !empty($adresse) && !empty($codePostal) && !empty($ville)) {
        try {
            $requeteUpdate = "UPDATE fournisseurs SET Societe=:societe, Adresse=:adresse, Code_postal=:codePostal, Ville=:ville, Commentaire=:commentaire WHERE idFournisseur=:fournisseurId";
            $statement = $connexion->prepare($requeteUpdate);
            $statement->bindParam(':societe', $societe);
            $statement->bindParam(':adresse', $adresse);
            $statement->bindParam(':codePostal', $codePostal);
            $statement->bindParam(':ville', $ville);
            $statement->bindParam(':commentaire', $commentaire);
            $statement->bindParam(':fournisseurId', $fournisseurId);
            $statement->execute();

            echo "<div class='container mt-5'>
                    <div class='alert alert-success' role='alert'>
                        Modification réussie !
                    </div>
                </div>";

        } catch (PDOException $e) {
            echo "<div class='container mt-5'>
                    <div class='alert alert-danger' role='alert'>
                        Erreur lors de la modification : " . $e->getMessage() . "
                    </div>
                </div>";
        }
    } else {
        echo "<div class='container mt-5'>
                <div class='alert alert-danger' role='alert'>
                    Les données sont invalides.
                </div>
            </div>";
    }
} else {
    echo "<div class='container mt-5'>
            <div class='alert alert-danger' role='alert'>
                Identifiant du fournisseur non spécifié ou méthode de requête incorrecte.
            </div>
        </div>";
}

if (isset($_GET['id'])) {
    $fournisseurId = $_GET['id'];

    try {
        $requeteFournisseur = "SELECT * FROM fournisseurs WHERE idFournisseur = :fournisseurId";
        $statement = $connexion->prepare($requeteFournisseur);
        $statement->bindParam(':fournisseurId', $fournisseurId);
        $statement->execute();
        $fournisseur = $statement->fetch(PDO::FETCH_ASSOC);

        if ($fournisseur) {
?>
<div class="container mt-5 text-center">
    <h1>Éditer un fournisseur</h1>
    <form action='ndex.php?page=modifSupplier' method='POST'>
        <input type='hidden' name='id' value='<?php echo $fournisseur['idFournisseur']; ?>'>
        <input type='hidden' name='action' value='update'>

        <div class="d-flex justify-content-center flex-column align-items-start">
            <label for='societe'>Société</label>
            <input type='text' id='societe' name='societe' value='<?php echo $fournisseur['Societe']; ?>'><br>

            <label for='adresse'>Adresse</label>
            <input type='text' id='adresse' name='adresse' value='<?php echo $fournisseur['Adresse']; ?>'><br>

            <label for='codePostal'>Code Postal</label>
            <input type='text' id='codePostal' name='codePostal' value='<?php echo $fournisseur['Code_postal']; ?>'><br>

            <label for='ville'>Ville</label>
            <input type='text' id='ville' name='ville' value='<?php echo $fournisseur['Ville']; ?>'><br>

            <label for='commentaire'>Commentaire</label>
            <input type='text' id='commentaire' name='commentaire'
                value='<?php echo $fournisseur['Commentaire']; ?>'><br>

            <button type='submit' class='btn btn-primary'>Valider</button>
        </div>
    </form>
</div>
<?php
        } else {
            echo "<div class='container mt-5'>
                    <div class='alert alert-danger' role='alert'>
                        Fournisseur non trouvé.
                    </div>
                </div>";
        }
    } catch (PDOException $e) {
        echo "<div class='container mt-5'>
                <div class='alert alert-danger' role='alert'>
                    Erreur : " . $e->getMessage() . "
                </div>
            </div>";
    }
}

?>
<div class="container mt-3 text-center">
    <a href='index?page=suppliersList' class='btn btn-danger'>Retourner aux fournisseurs</a>
</div>
<div class="container mt-3 text-center">
    <a href='index.php?page=home' class='btn btn-secondary'>Retour à l'accueil</a>
</div>