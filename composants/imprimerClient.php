<?php


function createTxt($client, $comptes){
    $fichier = fopen($client["nom"] . "_" . $client["id_client"] . ".txt", "w");
    fwrite($fichier, "Numéro client : " . $client["id_client"] . "\n");
    fwrite($fichier, "Nom : " . $client["nom"] . "\n");
    fwrite($fichier, "Prénom : " . $client["prenom"] . "\n");
    fwrite($fichier, "Date de naissance : " . $client["date_naissance"] . "\n");
    fwrite($fichier, "\n");
    fwrite($fichier, "------------------------------------------------------\n");
    fwrite($fichier, "Liste de compte\n");
    fwrite($fichier, "------------------------------------------------------\n");
    fwrite($fichier, "Numéro de compte\tSolde\tType_compte\n");
    fwrite($fichier, "------------------------------------------------------\n");
    foreach($comptes as $compte){
        $smiley = "";
        if($compte["type_compte"] !== "Livret A"){
            $smiley .= "\t";
            if($compte["type_compte"] == "PEL"){
                $smiley .= "\t";
            }
        }
        if($compte["solde"] > 0){
            $smiley .= ":-)";
            fwrite($fichier, $compte["id_compte"] . "\t\t\t" . $compte["solde"] . "\t" . $compte["type_compte"] . "\t\t\t" . $smiley . "\n");
        }
        else{
            $smiley .= ":-(";
            fwrite($fichier, $compte["id_compte"] . "\t\t\t" . $compte["solde"] . "\t" . $compte["type_compte"] . "\t\t\t" . $smiley . "\n");
        }
        
    }
    fclose($fichier);
}

function imprimerClient(){

    $listeClients = csvToArray(FILE_CLIENT);
    $listeComptes = csvToArray(FILE_COMPTE);

    $client = null;
    $comptes = [];
    showArray($listeClients);
    $recherche = readline("Entrer l'ID client svp : ");

    foreach($listeClients as $c){
        if($c[0] == $recherche){
            $client = [
                "id_client" => $c[0],
                "nom" => $c[2],
                "prenom" => $c[3],
                "date_naissance" => $c[4],
                "email" => $c[5],
            ];
            break;
        }
    }

    if(!$client){
        echo("Aucun client trouvé !\n");
    }
    else{
        foreach($listeComptes as $c){
            if($c[2] == $client["id_client"]){
                $compte = [
                    "id_compte" => $c[0],
                    "id_client" => $c[2],
                    "solde" => $c[3],
                    "decouvert_autorise" => $c[4],
                    "type_compte" => $c[5],
                ];
                $comptes[] = $compte;
            }
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
            echo("Numéro de compte\tSolde\tType_compte\n");
            echo("------------------------------------------------------\n");
            foreach($comptes as $compte){
                $smiley = "\t";
                if($compte["type_compte"] !== "Livret A"){
                    $smiley .= "\t";
                }
                if($compte["solde"] > 0){
                    $smiley .= ":-)";
                    echo("\033[32m" . $compte["id_compte"] . "\t\t" . $compte["solde"] . "\t" . $compte["type_compte"] . $smiley . "\033[0m\n");
                }
                else{
                    $smiley .= ":-(";
                    echo("\033[31m" . $compte["id_compte"] . "\t\t" . $compte["solde"] . "\t" . $compte["type_compte"] . $smiley . "\033[0m\n");
                }
                
            }
            echo("\n");

            $choix = readline("Voulez-vous créer un fichier .txt avec cette impression ? (O/N) : ");
            if($choix == "O"){
                createTxt($client, $comptes);
                echo("\nFichier créé.\n\n");
            }
        }
    }
}



?>