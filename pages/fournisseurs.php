<?php
$action = isset($_GET['action']) ? $_GET['action'] : 'liste'; // Par défaut, afficher la liste des fournisseurs

// Inclusion du fichier contenant la connexion PDO à la base de données
include 'connect.php';

    // Autres cas d'action peuvent être gérés ici

    switch ($action) {
        case 'liste':
        default:
            // Si aucune action d'édition n'est spécifiée, afficher la liste des fournisseurs
            echo "<div class='container'>
                    <h1>Gestion des Fournisseurs</h1>
                    <h2>Liste des Fournisseurs</h2>
                    <table class='table'>
                        <thead>
                            <tr>
                                <th>ID Fournisseur</th>
                                <th>Société</th>
                                <th>Adresse</th>
                                <th>Code Postal</th>
                                <th>Ville</th>
                                <th>Commentaire</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>";

            try {
                // Requête pour récupérer la liste des fournisseurs
                $requete = "SELECT idFournisseur, Societe, Adresse, Code_postal, Ville, Commentaire FROM fournisseurs";
                $resultat = $connexion->query($requete);
                $rows = $resultat->fetchAll(PDO::FETCH_ASSOC);

                foreach ($rows as $fournisseur) {
                    echo "<tr>";
                    echo "<td>" . $fournisseur['idFournisseur'] . "</td>";
                    echo "<td>" . $fournisseur['Societe'] . "</td>";
                    echo "<td>" . $fournisseur['Adresse'] . "</td>";
                    echo "<td>" . $fournisseur['Code_postal'] . "</td>";
                    echo "<td>" . $fournisseur['Ville'] . "</td>";
                    echo "<td>" . $fournisseur['Commentaire'] . "</td>";
                    echo "<td>";
                    // Icône pour éditer le fournisseur
                    echo "<a href='index.php?page=editSupplier&id=" . $fournisseur['idFournisseur'] . "'><i class='fas fa-pencil-alt'></i></a> ";
                    // Icône pour supprimer le fournisseur (avec pop-up de confirmation)
                    echo "<a href='index.php?page=deleteSupplier&id=" . $fournisseur['idFournisseur'] . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce fournisseur ?\")'><i class='fas fa-trash-alt'></i></a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }

            echo "</tbody>";
            echo "</table>";
            echo "<a href='index.php?page=home' class='btn btn-warning'>Retour à l'accueil</a>";
            echo "</div>";
            break;
    }

?>