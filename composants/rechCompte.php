<?

function rechCompte() {

    $listeComptes = csvToArray(FILE_COMPTE);
    showArray($listeComptes);

    $numCompte=readline ("Entrer votre n° de compte : ");
    $compte = null;

    foreach($listeComptes as $c){
        if($c[0] == $numCompte){
            $compte = $c;
        }
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