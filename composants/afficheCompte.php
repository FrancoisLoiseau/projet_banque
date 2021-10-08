<?php

function afficheCompte(){

    $listeComptes = csvToArray(FILE_COMPTE);
    $listeClients = csvToArray(FILE_CLIENT);
    showArray($listeClients);

    $idClient = readline("Entrer l'ID client : ");
    $comptes = [];

    foreach($listeComptes as $c){
        if($c[2] == $idClient){
            $comptes[] = [
                "num_compte" => $c[0],
                "code_agence" => $c[1],
                "id_client" => $c[2],
                "solde" => $c[3],
                "decouvert_autorise" => $c[4],
                "type_compte" => $c[5]
            ];
        }
    }

    if(count($comptes) == 0){
        echo("ID client non valide ou aucun compte trouvé.");
    }
    else{
        $i = 1;
        foreach($comptes as $compte){
            echo("\nCompte n°" . $i . " : \n");
            foreach($compte as $key => $value){
                echo($key . " : " . $value . "\n");
            }
            echo("\n");
            $i++;
        }
    }
}

?>