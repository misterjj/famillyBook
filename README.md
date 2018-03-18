Nom de code FamillyBook
========================

FamillyBook est un site à usage personnel afin de partager des photos entre membre d'une faimmile

Installer le projet
--------------

Installer les dépendances php

```bash
composer install
```

Installer les dépendances front

```bash
npm install
```

Build les statics

```bash
./node_modules/.bin/encore prod
```

Ajouter Un premier utilisateur

```bash
bin/console fos:user:create 
```

Passer un utilisateur admin

```bash
bin/console fos:user:promote [USER] ROLE_ADMIN 
```

Dépendances utilisées
--------------

* [Symfony 3](https://symfony.com/)
* [Webpack encore](https://github.com/symfony/webpack-encore)
* [FOSUserBundle](https://github.com/FriendsOfSymfony/FOSUserBundle)
* [Bootstrap 4](https://getbootstrap.com/)
* Liste complète dans composer.json et package.json

Auteurs
--------------

Germain *Angel* DESCLODURES et Jonathan *Misterjj* JORAND 

Copyrigth
--------------
L’ensemble de ce projet (contenu et présentation) constitue une œuvre protégée par la législation française et internationale en vigueur sur le droit d’auteur et d’une manière générale sur la propriété intellectuelle