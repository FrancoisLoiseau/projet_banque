<?php

function creerCompte(){

    $listeClients = csvToArray(FILE_CLIENT);
    $listeComptes = csvToArray(FILE_COMPTE);
    $listeAgences = csvToArray(FILE_AGENCE);

    $header = ["numero_compte" , "code_agence" , "id_client", "solde", "decouvert_autorise", "type_compte"];
    $numCompte = "";
    $client = null;
    $compteur = 0;
    $agence = null;
    $listeTypeCompte = [];

    while($client == null){
        showArray($listeClients);
        $recherche = readline("Entrez votre numéro de client : ");
        foreach($listeClients as $c){
            if($c[0] == $recherche){
                $client = $c[0];
                break;
            }
        }
        if ($client){
            foreach($listeComptes as $c){
                if($c[2] == $recherche){
                    $compteur++;
                    $agence = $c[1];
                    $listeTypeCompte[] = $c[5];
                }
            }
        }
        else{
            echo("Client non trouvé\n");
        }
        
    }

    if($compteur > 2){
        echo("Vous avez atteint le nombre maximum de comptes autorisés.");
    }
    else{
        showArray($listeAgences);
        while($agence == null){
            $idAgence = readline ("Veuillez saisir votre numéro d'agence (doit contenir 3 chiffres) : ");
            foreach($listeAgences as $a){
                if($a[0] == $idAgence){
                    $agence = $a[0];
                    $trouve = true;
                    break;
                }
            }
        }
        for($i=0; $i<11; $i++){
            $numCompte .= rand(0,9);
        }
        
        $solde = 0;
        $decouvert = chr(rand(78,79));
        if($decouvert == "O"){
            $solde = rand(-200, 1500);
        }
        else{
            $solde = rand(0, 1500);
        }

        $comptePossible = ["Livret A", "PEL", "Courant"];
        if($listeTypeCompte !== []){
            $comptePossible = array_diff($comptePossible, $listeTypeCompte);
        }

        $ch = "(Disponible : ";
        foreach($comptePossible as $type){
            $ch .= $type . " - ";
        }
        $ch .= ")";

        $typeCompte = readline ("Quel type de compte voulez vous ? " . $ch . " : ");
        while((!in_array($typeCompte, $comptePossible))){
            echo("Le type de compte voulu est incorrect ou existe déjà.\n");
            $typeCompte = readline ("Quel type de compte voulez vous ? " . $ch . " : ");
        }

        if (filesize("./bdd/compte.csv") > 0){
            $tab = [$numCompte, $agence, $client, $solde, $decouvert, $typeCompte];
            arrayToCsv("./bdd/compte.csv", $tab);
        }
        else{
            $tab = [$numCompte, $agence, $client, $solde, $decouvert, $typeCompte];
            arrayToCsv("./bdd/compte.csv", $header);
            arrayToCsv("./bdd/compte.csv", $tab);
        }
        echo("Votre nouveau numéro de compte bancaire est : " . $numCompte . "\n");
    }
}
    
?>