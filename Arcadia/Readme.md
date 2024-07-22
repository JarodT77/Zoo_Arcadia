# Déploiement de l'Application en local  

## Pré-requis

Avant de commencer, assurez-vous d'avoir installé les éléments suivants :
- [Git](https://git-scm.com/)
- [PHP](https://www.php.net/downloads.php)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/downloads/)
- [NOSQL](https://www.mongodb.com/)


## Installation en Local

### 1. Cloner le dépôt

Clonez le dépôt Git de votre application en utilisant la commande suivante :

```bash
git clone https://github.com/votre-utilisateur/votre-repo.git
cd votre-repo

2.Configurer les bases de donnees.

-Creer la base de donnee Mysql en local puis importer le fichier 'arcadia_zoo.sql' 
-Une fois la base de donnee importer lancer l'application sur votre serveur local directement avec le fichier index.php. em precisant bien le chemin du fichier 
exemple: http://localhost/arcadia/public/index.php