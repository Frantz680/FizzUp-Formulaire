# Last : 2022-12-21

------------
## Mode d'emploi:
- Assets:
  - appBack : CSS + JS backoffice
  - appFront : CSS + JS frontoffice
  - appFrontTools : Outils pour le front
- Controllers:
  - PublicsXXXX : pages front
  - AdminXXXX : pages back
  - AjaxpublicXXXX : requetes Ajax front
  - AjaxadminXXXX : requetes Ajax admin
  - Reset + Security : gestion des utilisateurs
- Templates:
  - Admin : pages admin
  - Bundles : base AdminLTE
  - Email : gestion des mails
  - Public : pages front
  - Base.html.twig : template de base Front

## Commandes:
- Installer Assets:
  - php74 bin/console assets:install
- Build les assets:
  - npm run build
- Créer un controller:
  - php74 bin/console make:controller NOMACHANGER
- Créer des entity:
  - php74 bin/console make:entity NOMACHANGER
- Créer un formulaire:
  - php74 bin/console make:form NOMACHANGER
- Générer les Getter et Setter:
  - php74 bin/console make:entity --regenerate
- Update BDD:
  - php74 bin/console doctrine:schema:update --force
- Vider cahe (mode simple):
  - php74 bin/console cache:clear
- Vider cahe (mode barbare):
  - rm -r var/cache 
  - mkdir var/cache
- Changer les droits du répértoire cache:
  - chmod -R 777 var/cache

## Pratique:
- Déboger les routes:
  - php74 bin/console debug:router

## Maintenance
- Installer des scripts (Encore):
  - npm i NOMSCRIPT
- Installer dépendance:
  - php74 composer.phar require NOMDEPENDANCE
- Update dépendances:
  - php74 composer.phar update
- Update NPM
  - npm upgrade

### Webpack

- php74 composer.phar require symfony/webpack-encore-bundle
- npm install
- npm install @symfony/webpack-encore --save-dev
- npm run watch
- npm run build
- npm run dev


### Image dans le build

- //https://symfony.com/doc/current/frontend/encore/copy-files.html

### knpMenuBundle

- https://symfony.com/bundles/KnpMenuBundle/current/index.html

### Ckeditor

- https://github.com/FriendsOfSymfony/FOSCKEditorBundle

- https://symfony.com/bundles/FOSCKEditorBundle/current/installation.html
  - composer require friendsofsymfony/ckeditor-bundle
  - Rajouter dans config/bundles.php 
    - FOS\CKEditorBundle\FOSCKEditorBundle::class => ['all' => true], 
  - Récuperation dans le dossier public du css/js nécessaire pour afficher l'éditeur 
    - php bin/console ckeditor:install
  - C'est installé, plus qu'à l'utiliser dans vos formulaires :
    - use FOS\CKEditorBundle\Form\Type\CKEditorType;
  - $builder->add('field', CKEditorType::class);
  - php bin/console assets:install public

- Dans twig.yaml :
  - form_themes:
    - Rajouter ça :  '@FOSCKEditor/Form/ckeditor_widget.html.twig'
  - Du côté Twig : pour ne pas afficher la mise en forme mais le texte brut :
    - post.content|striptags|replace({'&nbsp;': ''})|slice(0,50)

### 