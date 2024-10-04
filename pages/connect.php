<?php

// On défini la base de données MySQL avec PDO

define('HOST', "#");
define('DBNAME', "#");
define('USER', "#");
define('PASSWORD', "#");

try {

// on se connecte...

    $connexion = new PDO("mysql:host=" . HOST . ";dbname=" . DBNAME, USER, PASSWORD);

// Configuration pour afficher les erreurs PDO : 
// Ajout de PDOException dans le bloc catch pour capturer les exceptions spécifiques à PDO
// Et Configuration de l'attribut PDO::ATTR_ERRMODE pour afficher les erreurs PDO

    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //echo "Succès !!! La connexion MySQL est ok !<br />";
    

} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}

?>
