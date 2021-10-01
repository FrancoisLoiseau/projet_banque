<?php

function imprimerClient(){

    $recherche = readline("Entrer le numéro client svp : ");

    $client = [];
    $comptes = [];

    if(($fichier = fopen("./bdd/client.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($fichier, 1000, ";")) !== FALSE) {
            $taille = count($data);
            for ($i=0; $i < $taille; $i++) {
                if($data[$i] == $recherche){
                    $client = [
                        "id_client" => $data[0],
                        "nom" => $data[1],
                        "prenom" => $data[2],
                        "date_naissance" => $data[3],
                        "email" => $data[4],
                    ];
                    break;
                }
            }
        }
        fclose($fichier);
    }

    if($client == []){
        echo("Aucun client trouvé !\n");
    }
    else{
        if (($fichier = fopen("./bdd/compte.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($fichier, 1000, ";")) !== FALSE) {
                $taille = count($data);
                for ($i=0; $i < $taille; $i++) {
                    if($data[$i] == $client["id_client"]){
                        $compte = [
                            "id_compte" => $data[0],
                            "id_agence" => $data[1],
                            "id_client" => $data[2],
                            "solde" => $data[3],
                            "decouvert_autorise" => $data[4],
                        ];
                        $comptes[] = $compte;
                        break;
                    }
                }
            }
            fclose($fichier);
        }

        if($comptes == []){
            echo("Aucun compte trouvé !\n");
        }
        else{
            echo("\n");
            echo("Numéro client : " . $client["id_client"] . "\n");
            echo("Nom : " . $client["nom"] . "\n");
            echo("Prénom : " . $client["prenom"] . "\n");
            echo("Date de naissance : " . $client["date_naissance"] . "\n");
            echo("\n");
            echo("------------------------------------------------------\n");
            echo("Liste de compte\n");
            echo("------------------------------------------------------\n");
            echo("Numéro de compte\tSolde\t\n");
            echo("------------------------------------------------------\n");
            foreach($comptes as$compte){
                $smiley = "";
                if($compte["solde"] > 0){
                    $smiley = ":-)";
                }
                else{
                    $smiley = ":-(";
                }
                echo($compte["id_compte"] . "\t\t" . $compte["solde"] . "\t\t\t" . $smiley . "\n");
            }
            echo("\n");
        }
    }
}



?>