# SAKILA
Ce projet avait pour but de réaliser les fonctionnalités d'une entreprise de location de DVD. Pour cela, il était demandé de réaliser les fonctionnalités suivantes : 
  1. La consultation des DVD. 
  2. La location des DVD.
  3. La réservation des DVD.
  4. Afficher un film en fonction d'une recherche.

Ces fonctionnalitées seront utilisés par le personnel de l'entreprise et le devéloppement de ces fonctionnalités se codés dans un language objet.

## Installation du Projet 

* Etape 1 : créer la database "sakila" dans MySQL.

* Etape 2 : dans le dossier "sakila-db", importer le fichier "sakila-schema.sql" dans MySQL, et exécuter le script.

* Etape 3 : dans le dossier "sakila-db", importer le fichier "sakila-data.sql" dans MySQL, et exécuter le script.

* Etape 4 : dans le dossier "class", sélectionner le fichier "dbconfig", et modifier le mot de passe en fonction du votre : 
  * private $db_password = " ";
  * private $db_name= "sakila";

* Etape 5 : Lancer le projet :
<!--sec data-title="Prompt: OS X and Linux" data-id="OSX_Linux_prompt" data-collapse=true ces-->
    php -S localhost:8000 
<!--endsec-->

Votre url : http://localhost:8000/

## Technologie 
  * Framework Bootstrap : framework avec lequel je travaille le plus pour la mise en page d'un site.
  * MySQL : serveur de base de données relationnel que j'utilise à chaque fois dans les projets.
  * PHP : il était demandé d'utiliser un langage en objet, de plus c'est le seul langage objet que je maîtrise.
