
# Salle de sport

Ce site a été créé pour l'examen de fin de formation consistant à remplir les 8 compétences du titre professionnel


## Installation

Il faut d'abord cloner le projet avec la commande git clone et
le lien du projet https://github.com/Carole14/salle_3

Il faut ensuite installer les dépendances avec la commande
composer install

Il faut installer un serveur et une database sur votre ordinateur.
Pour ma part, j'ai installé MAMP et PhpMyAdmin.

Il faut modifier le fichier .env pour mettre à jour les informations.

Ensuite, il faut ajouter le compilateur webpack.

Efin, grâce à la commande symfony server:start et en allant sur
le lien http://localhost:8000, vous pourrez visualiser le projet.


## L'application contient

Le site contient les pages suivantes :
- La page de connexion
- La page pour voir la liste des partenaires
- La page pour voir la liste des structures
- La page pour créer un partenaire
- La page pour créer une structure
- La page profil du partenaire ou de la structure

Identifiants :

Administrateur :
-	Mail : mdupont@admin.com
-	Mot de passe : mdupont

Structure : 
-	Mail : structure1@structure.com
-	Mot de passe : structure


Partenaire :
-	Mail : partenaire1@partenaire.com
-	Mot de passe : partenaire



Mettre en ligne le site :
- j'ai créé un compte sur ionos
- j'ai pris un vps chez one and one
- Sur le vps, j'ai installé : apache, pg sql, php, composer, symfony et git
- j'ai activé le SSL : un protocole qui permet del s de https. Pour ce faire, je me suis créé un compte chez zero SSL. J'ai suivi la méthodologie pour générer un certificat
- j'ai gité salle_3
- j'ai fait pointé sur salle_3
