<?php

function rechClient(){

    $listeClients = csvToArray(FILE_CLIENT);
    $listeComptes = csvToArray(FILE_COMPTE);

    $nom = readline("Veuillez saisir votre nom: ");
    $numCompte = readline("Veuillez saisir votre numero de compte: ");
    $id = readline ("Veuillez entrer votre ID client: ");

    $listeNom = [];
    if(strlen($nom) > 0){
        foreach($listeClients as $c){
            if($c[2] == $nom){
                $client = [
                    "id_client" => $c[0],
                    "genre" => $c[1],
                    "nom" => $c[2],
                    "prenom" => $c[3],
                    "date_naissance" => $c[4],
                    "email" => $c[5],
                ];
                $listeNom[] = $client;
            }
        }
    }

    $listeId = [];
    if(strlen($id) > 0){
        foreach($listeClients as $c){
            if($c[0] == $id){
                $client = [
                    "id_client" => $c[0],
                    "genre" => $c[1],
                    "nom" => $c[2],
                    "prenom" => $c[3],
                    "date_naissance" => $c[4],
                    "email" => $c[5],
                ];
                $listeId[] = $client;
                break;
            }
        }
    }

    $listeCompte = [];
    if(strlen($numCompte) > 0){
        $idClient = null;
        foreach($listeComptes as $c){
            if($c[0] == $numCompte){
                $idClient = $c[2];
                break;
            }
        }
        if($idClient){
            foreach($listeClients as $c){
                if($c[0] == $idClient){
                    $client = [
                        "id_client" => $c[0],
                        "genre" => $c[1],
                        "nom" => $c[2],
                        "prenom" => $c[3],
                        "date_naissance" => $c[4],
                        "email" => $c[5],
                    ];
                    $listeCompte[] = $client;
                    break;
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