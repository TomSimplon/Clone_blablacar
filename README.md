# Clone de Blablacar

- Maquette figma : https://www.figma.com/file/LrFleRiNk7CgaqrdGvyC5g/kangouroute?type=design&node-id=0-1&t=Gw53xBf2FmljKvQj-0

- Cahier des charges : https://docs.google.com/document/d/1_inCMxHy1uK3qlbfmh_jhR4dEmnJraZF0Dbwp1a2a3E/edit

- Schéma de la base de données : https://drive.google.com/file/d/1IT2xIPWSHxHTBMv7Q2RT1ojemzybo9j6/view

- Démarrer le projet :
```shell
symfony composer req encore 
```

```shell
npm install node-sass sass-loader --save-dev
```

```shell
symfony server:start
```

```shell
npm run watch
```

```shell
php bin/console d:d:c
```

```shell
php bin/console d:m:m
```

```shell
php bin/console doctrine:fixtures:load

```

## Contexte du projet

- La ville de Chambéry souhaite mettre en place un système de covoiturage dans l’agglomération du grand Chambéry. Vous avez décroché l’appel d’offre pour la version 1 du projet.

- L’objectif est de créer une version minimale du produit à mettre entre les mains des utilisateurs puis adapter la suite du développement selon les retours des usagés. 

- En d’autres termes, la ville a accordé un budget très restreint pour le développement de la version 1 du projet, elle souhaite se concentrer sur les fonctionnalités, ce pour quoi aucun budget n’a été alloué au design de la plateforme. Vous êtes donc libre dans le design de la plateforme, néanmoins le client à donner des instructions : la plateforme aborde un design moderne, épuré et faisant echo à un monde moins polluant. Point important : le site doit être responsif.

- Un cahier des charges et un schéma de la base de données précis ont été remis par le responsable technique, ils doivent être scrupuleusement suivis. 



## Critères de performance

- Respect du cahier des charges techniques et fonctionnelles
- L’application respecte le modèle MVC
- Un jeu de fixtures pour peupler la base de données
- Les fonctionnalités attendues ne produisent pas d’erreurs
- Les pages sont fonctionnelles
- Le site est responsif
- Respect des bonnes pratiques de nommages / indentation / sémantique




