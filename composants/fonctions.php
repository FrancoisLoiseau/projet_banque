<?php

function csvToArray($chemin){
    $array = [];
    if($file = fopen($chemin, "r")){
        while (!feof($file)){
            print_r(fgetcsv($file, 1000, ";"));
            $array[] = fgetcsv($file, 1000, ";");
        }
        fclose($file);
    }
    return $array;
}

?>