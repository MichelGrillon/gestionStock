<?php
// Inclusion des fichiers nécessaires
include 'connect.php';

// Vérification de la présence de l'identifiant du produit dans l'URL
if (isset($_GET['id'])) {
    $produitId = $_GET['id'];

    try {
        // Requête préparée pour récupérer les informations du produit à éditer
        $requeteProduit = "SELECT * FROM produits WHERE idProduits = :produitId";
        $statement = $connexion->prepare($requeteProduit);
        $statement->bindParam(':produitId', $produitId);
        $statement->execute();
        $produit = $statement->fetch(PDO::FETCH_ASSOC);

        if ($produit) {
?>
<!-- Affichage du formulaire d'édition du produit -->
<div class="container mt-5">
    <h1>Éditer un produit</h1>
    <form action='index.php?page=modifProduct' method='POST'>
        <!-- Champ caché pour l'identifiant du produit -->
        <input type='hidden' name='id' value='<?php echo $produit['idProduits']; ?>'>
        <!-- Champs pour les différentes informations du produit -->
        <div class="row">
            <div class="col-md-3">
                <label for='reference' class="form-label text-start">Référence</label>
            </div>
            <div class="col-md-9">
                <input type='text' id='reference' name='reference' value='<?php echo $produit['Reference']; ?>'
                    class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for='nom' class="form-label text-start">Nom</label>
            </div>
            <div class="col-md-9">
                <input type='text' id='nom' name='nom' value='<?php echo $produit['Nom']; ?>' class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for='quantite' class="form-label text-start">Quantité</label>
            </div>
            <div class="col-md-9">
                <input type='text' id='quantite' name='quantite' value='<?php echo $produit['Quantite']; ?>'
                    class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for='idFournisseur' class="form-label text-start">ID Fournisseur</label>
            </div>
            <div class="col-md-9">
                <input type='text' id='idFournisseur' name='idFournisseur'
                    value='<?php echo $produit['idFournisseur']; ?>' class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label for='commentaire' class="form-label text-start">Commentaire</label>
            </div>
            <div class="col-md-9">
                <input type='text' id='commentaire' name='commentaire' value='<?php echo $produit['Commentaire']; ?>'
                    class="form-control">
            </div>
        </div>
        <!-- Bouton pour soumettre le formulaire -->
        <button type='submit' class='btn btn-success'>Valider</button>
    </form>

    <!-- Bouton pour annuler l'édition et revenir à la liste des produits -->
    <div class="my-3">
        <a href='index?page=productsList' class='btn btn-danger'>Annuler l'édition et retourner aux produits</a>
    </div>

    <!-- Bouton pour retourner à l'accueil -->
    <a href='index.php?page=home' class='btn btn-warning mt-3'>Retour à l'accueil</a>
</div>
<?php
        } else {
            echo "Produit non trouvé.";
        }
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Identifiant du produit non spécifié.";
}

?>