<?php

require 'modele.php';
try {

    $billets = getBillets();
    require 'vueAccueil.php';
} catch (Exception $e) {
    $msgErreur = $e->getMessage();
    require 'vueErreur.php';
}
