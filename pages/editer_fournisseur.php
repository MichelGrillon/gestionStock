<?php
// Inclusion des fichiers nécessaires
include 'connect.php';

// Vérification de l'action et de la présence de l'identifiant du fournisseur dans l'URL
if (isset($_GET['id'])) {
    $fournisseurId = $_GET['id'];

    try {
        // Requête préparée pour récupérer les informations du fournisseur à éditer
        $requeteFournisseur = "SELECT * FROM fournisseurs WHERE idFournisseur = :fournisseurId";
        $statement = $connexion->prepare($requeteFournisseur);
        $statement->bindParam(':fournisseurId', $fournisseurId);
        $statement->execute();
        $fournisseur = $statement->fetch(PDO::FETCH_ASSOC);

        if ($fournisseur) {
?>
<!-- Affichage du formulaire d'édition du fournisseur -->
<div class="container mt-5">
    <h1>Éditer un fournisseur</h1>
    <form action='index.php?page=modifSupplier' method='POST'>
        <!-- Champ caché pour l'identifiant du fournisseur -->
        <input type='hidden' name='id' value='<?php echo $fournisseur['idFournisseur']; ?>'>

        <!-- Champs pour les différentes informations du fournisseur -->
        <div class="row">
            <div class="col-md-3">
                <label for='societe' class="form-label text-start">Société</label>
            </div>
            <div class="col-md-9">
                <input type='text' id='societe' name='societe' value='<?php echo $fournisseur['Societe']; ?>'
                    class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for='adresse' class="form-label text-start">Adresse</label>
            </div>
            <div class="col-md-9">
                <input type='text' id='adresse' name='adresse' value='<?php echo $fournisseur['Adresse']; ?>'
                    class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for='codePostal' class="form-label text-start">Code Postal</label>
            </div>
            <div class="col-md-9">
                <input type='text' id='codePostal' name='codePostal' value='<?php echo $fournisseur['Code_postal']; ?>'
                    class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for='ville' class="form-label text-start">Ville</label>
            </div>
            <div class="col-md-9">
                <input type='text' id='ville' name='ville' value='<?php echo $fournisseur['Ville']; ?>'
                    class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for='commentaire' class="form-label text-start">Commentaire</label>
            </div>
            <div class="col-md-9">
                <input type='text' id='commentaire' name='commentaire'
                    value='<?php echo $fournisseur['Commentaire']; ?>' class="form-control">
            </div>
        </div>
        <!-- Bouton pour soumettre le formulaire -->
        <button type='submit' class='btn btn-success'>Valider</button>
    </form>

    <!-- Bouton pour annuler l'édition et revenir à la liste des fournisseurs -->
    <div class="my-3">
        <a href='index?page=suppliersList' class='btn btn-danger'>Annuler l'édition et retourner aux fournisseurs</a>
    </div>

    <!-- Bouton pour retourner à l'accueil -->
    <a href='index.php?page=home' class='btn btn-warning mt-3'>Retour à l'accueil</a>
</div>
<?php
        } else {
            echo "Fournisseur non trouvé.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Action non reconnue ou identifiant du fournisseur non spécifié.";
}

?>