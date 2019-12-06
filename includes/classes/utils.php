<?php


/**
 * Fonction qui retourne une chaîne de caractères aléatoire de longueur n.
 *
 * @param int           $n                  -   Longueur de la chaîne a generer
 *
 * @return string
 */
function randomString($n) {
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $n; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}


/**
 * Fonction qui retourne la source relative d'un fichier en fonction de l'emplacement actuel.
 *
 * @param string        $relative_src       -       Chemin d'accès relatif par défaut
 *
 * @return string
 */
function getSrc($relative_src) {
    $result_src = $relative_src;
    $nb = substr_count($_SERVER['REQUEST_URI'], "/", 0, strlen($_SERVER['REQUEST_URI']));
    return str_repeat("../", $nb - 1) . "." . $relative_src;
}


/**
 * Fonction qui rafraichit la variable de session.
 *
 * @param mysqlconnection   $connection         -   Connexion BDD effectuée dans le fichier config-db.php
 *
 * @return void
 */
function refreshSession($connection) {
    $query = $connection->prepare("SELECT * FROM kioui_accounts WHERE id = ?");
    $query->bind_param("s", $_SESSION['Data']['id']);
    $query->execute();
    $result = $query->get_result();
    $query->close();
    $userData = $result->fetch_assoc();
    $_SESSION['Data'] = $userData;
}


/**
 * Fonction retourne si la session est valide ou non
 *
 * @param mysqlconnection   $connection         -   Connexion BDD effectuée dans le fichier config-db.php
 *
 * @return boolean
 */
function isValidSession($connection) {
    refreshSession($connection);
    return $_SESSION['Data']['status'] == "ALIVE" && $_SESSION['LoggedIn'];
}


/**
 * Fonction qui indique si la catégorie du service sélectionnée est valide
 * 
 * @param string        $categorie              -   Categorie a verifier
 * 
 * @return boolean
 */
function categorieServiceExist($categorie) {
    return ($categorie == "DON" || $categorie == "TRANSPORT" || $categorie == "GARDIENNAGE" || $categorie == "TROC" || $categorie == "VENTE");
}


/**
 * Fonction qui indique si la catégorie du job sélectionnée est valide
 * 
 * @param string        $categorie              -   Categorie a verifier
 * 
 * @return boolean
 */
function categorieJobExist($categorie) {
    return ($categorie == "CDI" || $categorie == "CDD" || $categorie == "STAGE");
}

?>