<?php

function rechClient(){
    $nom = readline("Veuillez saisir votre nom: ");
    $num_de_compte = readline("Veuillez saisir votre numero de compte: ");
    $id = readline ("Veuillez entrer votre ID client: ");

    $listeClient = [];

    if(strlen($nom) > 0){
        if(($fichier = fopen("./bdd/client.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($fichier, 1000, ";")) !== FALSE) {
                if($data[2] == $nom){
                    $client = [
                        "id_client" => $data[0],
                        "genre" => $data[1],
                        "nom" => $data[2],
                        "prenom" => $data[3],
                        "date_naissance" => $data[4],
                        "email" => $data[5],
                    ];
                    $listeClient[] = $client;
                    break;
                }
            }
            fclose($fichier);
        }
    }

    if(strlen($id) > 0){
        if(($fichier = fopen("./bdd/client.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($fichier, 1000, ";")) !== FALSE) {
                if($data[0] == $id){
                    $client = [
                        "id_client" => $data[0],
                        "genre" => $data[1],
                        "nom" => $data[2],
                        "prenom" => $data[3],
                        "date_naissance" => $data[4],
                        "email" => $data[5],
                    ];
                    $listeClient[] = $client;
                    break;
                }
            }
            fclose($fichier);
        }
    }

    if(strlen($num_de_compte) > 0){
        $idClient = null;
        if (($fichier = fopen("./bdd/compte.csv", "r")) !== FALSE) {
            while (($data = fgetcsv($fichier, 1000, ";")) !== FALSE) {
                if($data[0] == $num_de_compte){
                    $idClient = $data[2];
                    break;
                }
            }
            fclose($fichier);
            if($idClient){
                if(($fichier = fopen("./bdd/client.csv", "r")) !== FALSE) {
                    while (($data = fgetcsv($fichier, 1000, ";")) !== FALSE) {
                        if($data[0] == $idClient){
                            $client = [
                                "id_client" => $data[0],
                                "genre" => $data[1],
                                "nom" => $data[2],
                                "prenom" => $data[3],
                                "date_naissance" => $data[4],
                                "email" => $data[5],
                            ];
                            $listeClient[] = $client;
                            break;
                        }
                    }
                    fclose($fichier);
                }
            } 
        }
    }

    $listeClient = array_unique($listeClient, SORT_REGULAR);

    $i = 1;
    foreach($listeClient as $client){
        echo("\nClient n°" . $i);
        echo(" -- ");
        foreach($client as $elt){
            echo($elt . ", ");
        }
        $i++;
    }
}


?>