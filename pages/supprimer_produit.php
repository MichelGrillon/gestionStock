<?php
include 'connect.php';
// Vérification de la présence de l'ID du produit à supprimer dans la requête GET
if (isset($_GET['id'])) {
    $produitId = $_GET['id'];

    try {
        // Requête préparée pour supprimer le produit
        $requeteSuppression = "DELETE FROM produits WHERE idProduits = :produitId";
        $statement = $connexion->prepare($requeteSuppression);
        $statement->bindParam(':produitId', $produitId);
        $statement->execute();

        echo "<div class='container mt-5'>
                <div class='alert alert-success' role='alert'>
                    Produit supprimé avec succès !
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
                Aucun identifiant de produit spécifié pour la suppression.
            </div>
        </div>";
}

// Boutons de retour
?>
<div class="container mt-3 text-center">
    <a href='index?page=productsList' class='btn btn-danger'>Retour à la gestion des produits</a>
</div>
<div class="container mt-3 text-center">
    <a href='index.php?page=home' class='btn btn-secondary'>Retour à l'accueil</a>
</div>