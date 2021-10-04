<?php

include('composants/creerClient.php');
include('composants/creerAgence.php');
include('composants/creerCompte.php');
include('composants/imprimerClient.php');

function afficheMenu(){
    echo("\n1. Créer une agence\n");
    echo("2. Créer un client\n");
    echo("3. Créer un compte bancaire\n");
    echo("4. Rechercher un compte\n");
    echo("5. Rechercher un client\n");
    echo("6. Afficher la liste des comptes d'un client\n");
    echo("7. Imprimer les informations client\n");
    echo("8. Quitter le programme\n");
}

$terminer = false;

while(!$terminer){

    afficheMenu();

    $choix = readline("\nEntrer votre choix : ");

    switch($choix){
        case 1:
            echo("=== CHOIX 1 : CRÉER UNE AGENCE ===\n");
            creerAgence();
            break;
        case 2:
            echo("=== CHOIX 2 : CRÉER UN CLIENT ===\n");
            creerClient();
            break;
        case 3:
            echo("=== CHOIX 3 : CRÉER UN COMPTE BANCAIRE ===\n");
            creerCompte();
            break;
        case 4:
            echo("=== CHOIX 4 : RECHERCHER UN COMPTE ===\n");
            break;
        case 5:
            echo("=== CHOIX 5 : RECHERCHER UN CLIENT ===\n");
            break;
        case 6:
            echo("=== CHOIX 6 : AFFICHER LA LISTE DES COMPTES D'UN CLIENT ===\n");
            break;
        case 7:
            echo("=== CHOIX 7 : IMPRIMER LES INFORMATIONS CLIENTS ===\n");
            imprimerClient();
            break;
        case 8:
            echo("=== CHOIX 8 : QUITTER ===\n");
            $terminer = true;
            break;
        default:
            echo("\n");
            afficheMenu();
            $choix = readline("Entrer votre choix : ");
            echo("\n");
    }

}

?>