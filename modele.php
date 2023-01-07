<?php

function getBillets()
{
    $bdd = getBdd();
    $billets = $bdd->query('select id as id, date_creation as date,'
        . ' titre as titre, contenu as contenu from billet'
        . ' order by id desc');
    return $billets;
}

// Renvoie les informations sur un billet
function getBillet($idBillet)
{
    $bdd = getBdd();
    $billet = $bdd->prepare('select id as id, date_creation as date,'
        . ' titre as titre, contenu as contenu from billet'
        . ' where id=?');
    $billet->execute(array($idBillet));
    if ($billet->rowCount() == 1) {
        return $billet->fetch();
    }
    // Accès à la première ligne de résultat
    else {
        throw new Exception("Aucun billet ne correspond à l'identifiant '$idBillet'");
    }

}

// Renvoie la liste des commentaires associés à un billet
function getCommentaires($idBillet)
{
    $bdd = getBdd();
    $commentaires = $bdd->prepare('select idCom as id, dateCom as date,'
        . ' auteurCom as auteur, contenuCom as contenu from commentaire'
        . ' where id_billet=?');
    $commentaires->execute(array($idBillet));
    return $commentaires;
}

// Effectue la connexion à la BDD
// Instancie et renvoie l'objet PDO associé
function getBdd()
{

    $bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8',
        'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $bdd;
}
