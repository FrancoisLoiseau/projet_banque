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

function arrayToCsv($chemin, $tab){
    $fichier = fopen($chemin, "a+");
    fputcsv($fichier, $tab, ";");
    fclose($fichier);
}

function showArray($tab){
    $taille = count($tab[0])-1;
    echo("\n");
    foreach($tab as $t){
        foreach($t as $elt){
            if($elt == $t[$taille]){
                echo($elt);
            }
            else{
                echo($elt . ", ");
            }
        }
        echo("\n");
    }
    echo("\n");
}

?>