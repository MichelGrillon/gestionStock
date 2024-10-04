<?php
   include 'pages/header.html';
   include 'pages/nav.html';

   if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'productsList':
            include 'pages/produits.php';
            break;
        case 'addProduct':
            include 'pages/ajouter_produit.php';
            break;
        case 'editProduct': 
            include 'pages/editer_produit.php'; 
            break;
        case 'modifProduct': 
            include 'pages/modification_produit.php'; 
            break;
        case 'deleteProduct': 
            include 'pages/supprimer_produit.php'; 
            break;
        case 'suppliersList':
            include 'pages/fournisseurs.php';
            break;
        case 'addSupplier':
            include 'pages/ajouter_fournisseur.php';
            break;
        case 'editSupplier': 
            include 'pages/editer_fournisseur.php'; 
            break;
        case 'modifSupplier': 
            include 'pages/modification_fournisseur.php'; 
            break;
        case 'deleteSupplier': 
            include 'pages/supprimer_fournisseur.php'; 
            break;
        default:
            include 'pages/error404.php'; // Gestion d'une page d'erreur si le paramètre est invalide
            break;
    }
} else {
    // Gérer la page par défaut ici si aucun paramètre n'est spécifié
    //include 'pages/defaultPage.php';
}

include 'pages/footer.html';
?>