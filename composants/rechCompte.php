<?php

$idCompte = readline("Entrer le numéro de compte que vous voulez voir : ");
$compte = null;

if(($fichier = fopen("./bdd/compte.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($fichier, 1000, ";")) !== FALSE) {
        if($data[0] == $idCompte){
            $compte = [
                "num_compte" => $data[0],
                "code_agence" => $data[1],
                "id_client" => $data[2],
                "solde" => $data[3],
                "decouvert_autorise" => $data[4],
                "type_compte" => $data[5]
            ];
            break;
        }
    }
}

if($compte){
    echo("\n");
    foreach($compte as $key => $value){
        echo($key . " : " . $value . "\n");
    }
    echo("\n");
}
else{
    echo("\n");
    echo("Aucun compte bancaire trouvé.");
}

?>