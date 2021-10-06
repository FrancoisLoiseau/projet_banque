<?php

function rechClient(){
    $nom = readline("Veuillez saisir votre nom: ");
    $num_de_compte = readline("Veuillez saisir votre numero de compte: ");
    $id = readline ("Veuillez entrer votre ID client: ");

    $listeNom = [];
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
                    $listeNom[] = $client;
                }
            }
            fclose($fichier);
        }
    }

    $listeId = [];
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
                    $listeId[] = $client;
                    break;
                }
            }
            fclose($fichier);
        }
    }

    $listeCompte = [];
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
                            $listeCompte[] = $client;
                            break;
                        }
                    }
                    fclose($fichier);
                }
            } 
        }
    }

    $i = 1;
    echo("\n\n== Recherche par nom ==\n\n");
    if(count($listeNom) > 0){
        foreach($listeNom as $client){
            echo("Client n°" . $i);
            echo(" -- ");
            foreach($client as $elt){
                if($elt == $client["email"]){
                    echo($elt . "\n");
                }
                else{
                    echo($elt . ", ");
                }
            }
            $i++;
        }
    }
    else{
        echo("Aucun résultat par nom");
    }

    echo("\n\n== Recherche par ID client ==\n\n");
    if(count($listeId) > 0){
        foreach($listeId as $client){
            echo("Client n°" . $i);
            echo(" -- ");
            foreach($client as $elt){
                if($elt == $client["email"]){
                    echo($elt . "\n");
                }
                else{
                    echo($elt . ", ");
                }
            }
            $i++;
        }
    }
    else{
        echo("Aucun résultat par ID client");
    }


    echo("\n\n== Recherche par numéro de compte ==\n\n");
    if(count($listeCompte) > 0){
        foreach($listeCompte as $client){
            echo("Client n°" . $i);
            echo(" -- ");
            foreach($client as $elt){
                if($elt == $client["email"]){
                    echo($elt . "\n");
                }
                else{
                    echo($elt . ", ");
                }
            }
            echo("\n");
            $i++;
        }
    }
    else{
        echo("Aucun résultat par numéro de compte\n");
    }

}


?>