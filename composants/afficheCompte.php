<?php

function afficheCompte(){

    $idClient = readline("Entrer l'id client : ");
    $comptes = [];

    if (($fichier = fopen("./bdd/compte.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($fichier, 1000, ";")) !== FALSE) {
            if($data[2] == $idClient){
                $comptes[] = $compte = [
                    "num_compte" => $data[0],
                    "code_agence" => $data[1],
                    "id_client" => $data[2],
                    "solde" => $data[3],
                    "decouvert_autorise" => $data[4],
                    "type_compte" => $data[5]
                ];
            }
        }
        fclose($fichier);
    }

    if(count($comptes) == 0){
        echo("ID client non valide ou aucun compte trouvé.");
    }
    else{
        $i = 1;
        foreach($comptes as $compte){
            echo("\nCompte n°" . $i . " : \n");
            foreach($compte as $key => $value){
                echo($key . " : " . $value . "\n\n");
            }
            echo("\n");
            $i++;
        }
    }
}

?>