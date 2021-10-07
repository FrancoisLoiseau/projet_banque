<?php

function creerClient(){
    $header = ["id_client", "genre", "nom", "prenom", "date_naissance", "mail"];

    $genre = readline ("Veuillez saisir votre genre (taper Homme ou Femme) : ");
    while ($genre != "Homme" && $genre != "Femme"){
        $genre = readline ("Veuillez saisir un genre valide (Homme ou Femme) : ");
        }
    $nom = readline ("Entrez votre nom de famille : ");
    $prenom = readline ("Entrez votre prénom : ");
    $age = readline ("Entrez votre date de naissance (JJ/MM/AAAA) : ");
    while(!(preg_match('/^(((0[1-9])|(1\d)|(2\d)|(3[0-1]))\/((0[1-9])|(1[0-2]))\/(\d{4}))$/', $age))) {
        echo "Le format de la date n'est pas conforme. \n";
        $age = readline ("Entrez votre date de naissance avec le bon format (JJ/MM/AAAA) : ");
    }
    $mail = readline ("Veuillez entrer votre e-mail : ");
    while (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        echo "Le format de l' e-mail n'est pas conforme. \n";
        $mail = readline ("Entrez le bon format de mail : ");
    }

    for($i=0; $i<8; $i++){
        $id = chr(rand(65,90)) . chr(rand(65,90));
        $id .= rand(100000, 999999);
    }

    if(filesize("bdd/client.csv") > 0){
        if(($f = fopen("./bdd/client.csv", "a+")) !== FALSE) { //On ouvre le fichier si possible
            while (($data = fgetcsv($f, 1000, ";")) !== FALSE) { //Tant que l'on est pas à la fin du fichier, on recupère chaque ligne
                if($data[0] == $id){ // Si on trouve la valeur recherchée
                    for($i=0; $i<8; $i++){
                        $id = chr(rand(65,90)) . chr(rand(65,90));
                        $id .= rand(100000, 999999);
                    }
                    fseek($f, 0);
                }
            }
        }
        $tab = [$id, $genre, $nom, $prenom, $age, $mail];
        fputcsv($f, $tab, ";");
        fclose($f); // On ferme le fichier
    }
    else{
        $f = fopen("./bdd/client.csv", "a+");
        $tab = [$id, $genre, $nom, $prenom, $age, $mail];
        fputcsv($f, $header, ";");
        fputcsv($f, $tab, ";");
        fclose($f); // On ferme le fichier
    }

    echo("Votre ID est: " . $id);

    echo "\n";
    }   
?>