<?php
// Inclusion du fichier de connexion
include 'connect.php';

// Vérification si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs du formulaire
    $societe = $_POST['societe'];
    $adresse = $_POST['adresse'];
    $codePostal = $_POST['codePostal'];
    $ville = $_POST['ville'];
    $commentaire = $_POST['commentaire'];

    try {
        // Requête préparée pour l'insertion d'un nouveau fournisseur
        $requeteInsertion = "INSERT INTO fournisseurs (Societe, Adresse, Code_postal, Ville, Commentaire) VALUES (:societe, :adresse, :codePostal, :ville, :commentaire)";
        $statement = $connexion->prepare($requeteInsertion);

        // Liaison des paramètres avec les valeurs
        $statement->bindParam(':societe', $societe);
        $statement->bindParam(':adresse', $adresse);
        $statement->bindParam(':codePostal', $codePostal);
        $statement->bindParam(':ville', $ville);
        $statement->bindParam(':commentaire', $commentaire);

        // Exécution de la requête préparée
        $statement->execute();

        echo "Nouveau fournisseur ajouté avec succès.";
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Ajouter un Fournisseur</h2>
    <form action="index.php?page=addSupplier" method="POST">
        <!-- Formulaire pour ajouter un fournisseur -->
        <!-- Champ pour la société -->
        <div class="mb-3">
            <label for="societe" class="form-label">Société</label>
            <input type="text" class="form-control" id="societe" name="societe">
        </div>
        <!-- Champ pour l'adresse -->
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="adresse" name="adresse">
        </div>
        <!-- Champ pour le code postal -->
        <div class="mb-3">
            <label for="codePostal" class="form-label">Code Postal</label>
            <input type="text" class="form-control" id="codePostal" name="codePostal">
        </div>
        <!-- Champ pour la ville -->
        <div class="mb-3">
            <label for="ville" class="form-label">Ville</label>
            <input type="text" class="form-control" id="ville" name="ville">
        </div>
        <!-- Champ pour le commentaire -->
        <div class="mb-3">
            <label for="commentaire" class="form-label">Commentaire</label>
            <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
        </div>
        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-success">Ajouter Fournisseur</button>
        <br />
        <!-- Lien pour retourner à l'accueil -->
        <a href="index.php?page=home" class="btn btn-warning mt-3">Retour à l'accueil</a>
    </form>
</div>