<?php

require_once __DIR__ . '/controllers/MainController.php';

// on récupère le param '_url' (qui nous vient de la réécriture via htaccess) => savoir quelle page a été demandée par l'utilisateur (page courante)
// si on cherche un paramètre d'url, on regarde dans $_GET
// si l'utilisateur n'a pas demandé de page particulière, on estime que c'est la home qui est demandée
if (isset($_GET['_url'])) {
    $currentPage = $_GET['_url'];
} else {
    // aucune page particulière n'a été demandée
    // il faut tout de même définir un template à afficher, et donc un nom de page courante
    $currentPage = '/home'; // la home par défaut
}

// instanciation d'un mainController => obligatoire pour pouvoir afficher une vue
$mainController = new MainController();
// différentes méthodes qui sont mises à disposition par MainController
// home(), products() et store()
// il faut réussi à appeler une de ces méthodes en fonction de la page courante


/**************************** Routing **************************/
// ici, on fait la correspondance entre 
// - la page courante (demandée par l'utilisateur) => $currentPage
// - la méthode de contrôleur qui va faire l'affichage
// la méthode appelée sur mainController porte le même nom que les valeurs attendues pour $currentPage :
// 'home', 'products', 'store'
// On va donc demander à php de déclencher la méthode qui porte le nom de la page courante

// on doit vérifier que la méthode qui sera appelée sur mainController est prévue)
// ici, on ajoute une étape de définition des pages qui sont prévues
// on liste donc les valeurs qu'on veut autoriser pour $currentPage
// pour pouvoir vérifier que $currentPage trouve son équivalent dans les clés de l'array $existingPages
// dans ce tableau on définit quelle méthode de contrôleur on veut utiliser pour chaque page
// le nom de chaque page dans l'url => la route commence par un /
$existingPages = [
    '/home' => 'homepage',
    '/products' => 'products',
    '/store' => 'store'
];


// vérifier que $currentPage est une clé existante dans la définition des pages ($existingPages)
// si ce n'est pas le cas, on déclenche une erreur 404
if (array_key_exists($currentPage, $existingPages) == false) {
    $mainController->error404(); // error404() fait un exit, donc pas besoin de prévoir un else, on ira plus loin
}

// on récupère le nom de la méthode à utiliser en fonction de la page courante
$methodToUse = $existingPages[$currentPage];

/**************************** Fin Router **************************/
/**************************** Dispatch **************************/
// Dispatch => effectuer l'appel à la méthode de contrôleur qui correspond à la page courante
// Si $currentPage vaut 'home' :
// Cette chaîne vaudrait '$mainController->home()'
// '$mainController->' . $currentPage . '()'

// PHP est capable de comprendre une syntaxe qui fait la même chose :
$mainController->$methodToUse(); // si $currentPage vaut 'home', on déclenche la méthode home de mainController
// = on déclenche *dynamiquement* une méthode
/**************************** Fin Dispatch **************************/
