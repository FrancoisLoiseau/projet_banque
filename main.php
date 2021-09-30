<?php


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
            echo("=== CHOIX 1 ===\n");
            break;
        case 2:
            echo("=== CHOIX 2 ===\n");
            break;
        case 3:
            echo("=== CHOIX 3 ===\n");
            break;
        case 4:
            echo("=== CHOIX 4 ===\n");
            break;
        case 5:
            echo("=== CHOIX 5 ===\n");
            break;
        case 6:
            echo("=== CHOIX 6 ===\n");
            break;
        case 7:
            echo("=== CHOIX 7 ===\n");
            break;
        case 8:
            echo("=== CHOIX 8 ===\n");
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