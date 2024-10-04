<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $produitId = $_POST['id'];

    // Récupération des valeurs du formulaire
    $reference = htmlspecialchars($_POST['reference']);
    $nom = htmlspecialchars($_POST['nom']);
    $quantite = intval($_POST['quantite']); // Assure que la quantité est un nombre entier
    $idFournisseur = intval($_POST['idFournisseur']); // Assure que l'ID du fournisseur est un nombre entier
    $commentaire = htmlspecialchars($_POST['commentaire']);

    // Validation des données
    if ($quantite > 0 && $idFournisseur > 0) { // Exemple de validation simple
        try {
            // Requête de mise à jour
            $requeteUpdate = "UPDATE produits SET Reference=:reference, Nom=:nom, Quantite=:quantite, idFournisseur=:idFournisseur, Commentaire=:commentaire WHERE idProduits=:produitId";
            $statement = $connexion->prepare($requeteUpdate);
            $statement->bindParam(':reference', $reference);
            $statement->bindParam(':nom', $nom);
            $statement->bindParam(':quantite', $quantite);
            $statement->bindParam(':idFournisseur', $idFournisseur);
            $statement->bindParam(':commentaire', $commentaire);
            $statement->bindParam(':produitId', $produitId);
            $statement->execute();

            // Affichage d'un message de confirmation
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
                Identifiant du produit non spécifié ou méthode de requête incorrecte.
            </div>
        </div>";
}
?>

<!-- Formulaire avec champs centrés -->
<div class="container mt-5 text-center">

    <form action='index.php?page=modifProduct' method='POST'>
        <!-- Champ caché pour l'identifiant du produit -->
        <input type='hidden' name='id' value='<?php echo $produit['idProduits']; ?>'>

        <div class="my-3">
            <a href='index?page=productsList' class='btn btn-danger'>Retourner aux produits</a>
        </div>
        <!-- Bouton pour retourner à l'accueil -->
        <a href='index.php?page=home' class='btn btn-secondary mt-3'>Retour à l'accueil</a>
</div>