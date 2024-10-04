<?php
include 'connect.php';

// Vérification de la présence de l'ID du fournisseur à supprimer dans la requête GET
if (isset($_GET['id'])) {
    $fournisseurId = $_GET['id'];

    try {
        // Requête préparée pour supprimer le fournisseur
        $requeteSuppression = "DELETE FROM fournisseurs WHERE idFournisseur = :fournisseurId";
        $statement = $connexion->prepare($requeteSuppression);
        $statement->bindParam(':fournisseurId', $fournisseurId);
        $statement->execute();

        echo "<div class='container mt-5'>
                <div class='alert alert-success' role='alert'>
                    Fournisseur supprimé avec succès !
                </div>
            </div>";

    } catch (PDOException $e) {
        echo "<div class='container mt-5'>
                <div class='alert alert-danger' role='alert'>
                    Erreur lors de la suppression : " . $e->getMessage() . "
                </div>
            </div>";
    }
} else {
    echo "<div class='container mt-5'>
            <div class='alert alert-danger' role='alert'>
                Aucun identifiant de fournisseur spécifié pour la suppression.
            </div>
        </div>";
}

// Boutons de retour
?>
<div class="container mt-3 text-center">
    <a href='index?page=suppliersList' class='btn btn-danger'>Retour à la gestion des fournisseurs</a>
</div>
<div class="container mt-3 text-center">
    <a href='index.php?page=home' class='btn btn-secondary'>Retour à l'accueil</a>
</div>