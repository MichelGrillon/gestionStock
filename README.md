# gestionStock
 gestion simple en php

La demande client :

Il s'agit de créer une version simplifiée d'un logiciel de gestion de stock. Pour cela le client nous a donné les informations suivantes :

- un menu simple contenant les entrées suivantes : Produits, Fournisseurs puis un sous menu pour chaque : Lister, Ajouter
- le sous-menu s'affichera en cliquant sur Produits ou Fournisseurs (menu en javascript ou css à votre convenance)
- un formulaire permettant d'ajouter un produit :
    - Référence,
    - Nom,
    - Quantité,
    - Fournisseur (sous forme d'une liste déroulante),
    - Commentaire
- un formulaire permettant d'ajouter un fournisseur :
    - Société,
    - Adresse,
    - Code postal,
    - Ville,
    - Commentaire
- sur l'option "Produit" et "Fournisseur", la liste contient tous les items de la table correspondante qui s'affichent dans un tableau avec les dernières colonnes contenant
- un stylo pour l'éditer
- une corbeille pour le supprimer
- Utilisez Boostrap pour la mise en forme
Réalisez cette application en utilisant PDO avec des requêtes préparées pour communiquer avec la base de données.

Application avec une unique entrée, c'est-à-dire l'index.php. Dans celui-ci, vous récupérez le paramètre défini dans toutes vos URL (menu et formulaire).

Par exemple :

index.php?page=addProducts   // OU

index.php?page=formAddProduct

C'est ce paramètre "page" que vous récupérez en GET dans l'index pour ensuite le tester dans un switch, par exemple, ou un if...elseif...else. Selon la valeur récupérée, vous faites un "include" du fichier correspondant à l'action recherchée et la valeur de "page".

En ce qui concerne la partie HTML, créez trois fichiers HTML distincts : header, nav, et footer. Incluez-les également dans l'index. Le header et la nav avant le switch, puis le footer après le switch.

Ainsi, toute la structure commune à toutes les pages se chargera une seule fois. Le contenu principal du site sera dynamique en fonction de la valeur récupérée dans "page". Cela permettra une meilleure organisation et maintenance de votre code.

Pensez à bien prévoir un identifiant pour chaque enregistrement que ce soit produit ou fournisseur.
Voici un Modèle Logique de Données.
La table produits contient les fiches produits; chaque fiche produit a un identifiant produit unique mais il peut y avoir plusieurs fois la même référence. Cependant, chaque référence doit être rattachée à un identifiant fournisseur et un seul.
La table fournisseurs contient les fiches fournisseurs; chaque fournisseur est unique.
le lien est intégré à la table produit sous forme d'une clé étrangère.

![image](https://github.com/user-attachments/assets/f4b9f4a6-08cf-425f-a466-59a346ec16d2)

