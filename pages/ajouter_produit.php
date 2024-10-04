<?php
// Inclusion du fichier de connexion
include 'connect.php';

    // Vérification si la requête est de type POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des valeurs du formulaire
        $Reference = $_POST['reference'];
        $Nom = $_POST['nom'];
        $Quantite = $_POST['quantite'];
        $idFournisseur = $_POST['idFournisseur']; // Correction du nom du champ pour correspondre au formulaire
        $Commentaire = $_POST['commentaire'];

        try {
            // Requête préparée pour l'insertion d'un nouveau produit
            $requeteInsertion = "INSERT INTO produits (Reference, Nom, Quantite, idFournisseur, Commentaire) VALUES (:Reference, :Nom, :Quantite, :idFournisseur, :Commentaire)";
            $statement = $connexion->prepare($requeteInsertion);
            
            // Liaison des paramètres avec les valeurs
            $statement->bindParam(':Reference', $Reference);
            $statement->bindParam(':Nom', $Nom);
            $statement->bindParam(':Quantite', $Quantite);
            $statement->bindParam(':idFournisseur', $idFournisseur);
            $statement->bindParam(':Commentaire', $Commentaire);
            
            // Exécution de la requête préparée
            $statement->execute();
            
            echo "Nouvelle ligne insérée avec succès.";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    }

?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Ajouter un Produit</h2>
    <form action="index.php?page=addProduct" method="POST">
        <!-- Formulaire pour ajouter un produit -->
        <!-- Champ pour la référence -->
        <div class="mb-3">
            <label for="reference" class="form-label">Référence</label>
            <input type="text" class="form-control" id="reference" name="reference">
        </div>
        <!-- Champ pour le nom -->
        <div class="mb-3">
            <label for="nom" class="form-label">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom">
        </div>
        <!-- Champ pour la quantité -->
        <div class="mb-3">
            <label for="quantite" class="form-label">Quantité</label>
            <input type="text" class="form-control" id="quantite" name="quantite">
        </div>
        <!-- Sélection du fournisseur -->
        <div class="mb-3">
            <label for="idFournisseur" class="form-label">Fournisseur</label>
            <select class="form-select" id="idFournisseur" name="idFournisseur">
                <?php
                    // Requête pour récupérer les fournisseurs
                    $queryFournisseurs = "SELECT idFournisseur, Societe FROM fournisseurs";
                    $resultFournisseurs = $connexion->query($queryFournisseurs);
                    $fournisseurs = $resultFournisseurs->fetchAll(PDO::FETCH_ASSOC);

                    // Affichage des options pour les fournisseurs
                    foreach ($fournisseurs as $fournisseur) {
                        echo "<option value='" . $fournisseur['idFournisseur'] . "'>" . $fournisseur['Societe'] . "</option>";
                    }
                    ?>
            </select>
        </div>
        <!-- Champ pour le commentaire -->
        <div class="mb-3">
            <label for="commentaire" class="form-label">Commentaire</label>
            <textarea class="form-control" id="commentaire" name="commentaire" rows="3"></textarea>
        </div>
        <!-- Bouton de soumission -->
        <button type="submit" class="btn btn-success">Ajouter Produit</button>
        <br />
        <!-- Lien pour retourner à l'accueil -->
        <a href="index.php?page=home" class="btn btn-warning mt-3">Retour à l'accueil</a>
    </form>
</div>