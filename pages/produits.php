<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'liste'; // Par défaut, afficher la liste des produits

include 'connect.php';

switch ($action) {
    case 'liste':
    default:
        try {
            $requeteProduits = "SELECT p.idProduits, p.Reference, p.Nom, p.Quantite, p.idFournisseur, p.Commentaire, f.idFournisseur, f.Societe AS NomFournisseur 
                    FROM produits p 
                    INNER JOIN fournisseurs f ON p.idFournisseur = f.idFournisseur
                    ORDER BY CAST(SUBSTRING(p.Reference, 4) AS UNSIGNED), SUBSTRING(p.Reference, 1, 3)";


            $statement = $connexion->prepare($requeteProduits);
            $statement->execute();
            $produits = $statement->fetchAll(PDO::FETCH_ASSOC);

            echo "<div class='container mt-5'>";
            echo "<h2 class='text-center mb-4'>Liste des Produits</h2>";
            echo "<table class='table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th scope='col'>ID Produit</th>";
                echo "<th scope='col'>Référence</th>";
                echo "<th scope='col'>Nom</th>";
                echo "<th scope='col'>Quantité</th>";
                echo "<th scope='col'>ID Fournisseur</th>";
                echo "<th scope='col'>Nom Fournisseur</th>";
                echo "<th scope='col'>Commentaire</th>";
                echo "<th scope='col'>Actions</th>"; // Ajout de la colonne Actions
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                foreach ($produits as $produit) {
                    //var_dump($produit['idProduits']); // Affichage de la valeur de l'identifiant du produit
                    echo "<tr>";
                    echo "<th scope='row'>" . $produit['idProduits'] . "</th>";
                    echo "<td>" . $produit['Reference'] . "</td>";
                    echo "<td>" . $produit['Nom'] . "</td>";
                    echo "<td>" . $produit['Quantite'] . "</td>";
                    echo "<td>" . $produit['idFournisseur'] . "</td>"; // Affichage de l'ID fournisseur
                    echo "<td>" . $produit['NomFournisseur'] . "</td>"; // Affichage du nom du fournisseur
                    echo "<td>" . $produit['Commentaire'] . "</td>";
                    echo "<td>";
                    // Icône pour éditer le produit
                    echo "<a href='index.php?page=editProduct&id=" . $produit['idProduits'] . "'><i class='fas fa-pencil-alt'></i></a> ";
                    // Icône pour supprimer le produit (avec pop-up de confirmation)
                    echo "<a href='index.php?page=deleteProduct&id=" . $produit['idProduits'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce produit ?\")'><i class='fas fa-trash-alt'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";
                echo "<a href='index.php?page=home' class='btn btn-warning'>Retour à l'accueil</a>";
            echo "</div>";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
        break;
}
?>