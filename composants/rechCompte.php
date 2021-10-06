<?

function rechCompte() {

    $num_compte=readline ("Entrer votre n° de compte : ");
    $compte = null;

    if (($fichier=fopen("./bdd/compte.csv","r")) !== false) {
        while(($data=fgetcsv($fichier,1000,";")) !== false) {
            if($data[0]==$num_compte) {
                $compte=[$data[0], $data[1], $data[2], $data[3], $data[4], $data[5]];
                break;
            }
        }
        fclose ($fichier);
    }

    if($compte == null){
        echo("Aucun compte trouvé !\n");
    }
    else{
        $taille = count($compte) - 1;
        $ch = "Compte : ";
        foreach($compte as $elt){
            if($elt == $compte[$taille]){
                $ch .= $elt;
            }
            else{
                $ch .= $elt . ", ";
            }
        }
        echo($ch . "\n");
    }
}
?>