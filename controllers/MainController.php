<?php

class MainController {
    
    // Les méthodes de contrôleurs servent à préparer les données à afficher sur la page
    // plus généralement, faire les traitements qui ne seront faits que pour cette page
    // - récupérer des données en BDD
    // - enregistrer des données en BDD après la soumission d'un formulaire
    // - envoyer un email automatiquement
    // - ...
    // On veut FORCEMENT passer par une méthode de contrôleur (action) pour afficher une page
    // => on veut interdire l'appel externe à la méthode show
    
    // action
    // décléncher l'affichage la page home
    public function homepage() {

        // on peut faire des traitement du type : 
        // l'utilisateur est-il connecté ?
            // oui -> afficher la vue home-connected avec $this->show('home-connected')
            // non afficher la vue home avec $this->show('home')
        // on aurait pu avoir besoin de récupérer des données
        // on aurait pu avoir besoin de récupérer l'utilisateur connecté
        // => on l'aurait fait ici

        // faire l'affichage de la home
        $this->show('home');
    }

    // action
    // décléncher l'affichage la page products
    public function products() {
        // faire l'affichage de la page products
        $this->show('products');
    }

    // action
    // décléncher l'affichage la page store
    public function store() {
        // faire l'affichage de la page store
        $this->show('store');
    }

    // action
    // déclencher une erreur 404
    public function error404() {
        // donner un code HTTP choisi
        http_response_code(404);
        exit();
    }

    // afficher les views
    private function show($currentPage) {

        // require => va chercher le code d'un fichier
        // require_once => va chercher le code d'un fichier qui n'a pas encore été require
        // attention, ici, dans MainController.php, __DIR__ vaut /var/www/html/..../s05-e01-coffee-shop-GaetanOclock/controllers
        require_once __DIR__ . "/../views/header.tpl.php";
        require_once __DIR__ . "/../views/{$currentPage}.tpl.php";
        require_once __DIR__ . "/../views/footer.tpl.php";
    }
}
