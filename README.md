# ATEXO-game
C'est une application de jeu de cartes pour ATEXO.

## Logiciels requis

-   PHP **8.0+**

## Installation


### Clonage du repository
1- Clonons le repository !

```
git clone https://github.com/hamdi-garfi/atexo-game.git ./atexo
```
2- Changer le dossier
```
cd atexo
```

3- lancer l'application sur docker
```
docker-compose up --build
```

### Usage
Lancer l'application sur http://localhost:8080



Configuration
Dans le fichier .env, remplissez les informations liées à la base de données que vous devez préalablement créer.

Tests
-----

Exécutez cette commande pour lancer les tests

```bash
$ cd my_project/
$ ./bin/phpunit
