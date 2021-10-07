<?php

function csvToArray($chemin){
    $tab = [];
    if(($fichier = fopen($chemin, "r")) !== FALSE) {
        while (($data = fgetcsv($fichier, 1000, ";")) !== FALSE) {
            $tab[] = $data;
        }
        fclose($fichier);
    }
    return $tab;
}



?>