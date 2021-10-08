<?

include('composants/fonctions.php');
include('composants/constantes.php');

function creerAgence(){

    $listeAgences = csvToArray(FILE_AGENCE);

    $header = ["code_agence", "nom", "adresse"];
    
    $nom = readline ("Entrer le nom de l'agence : ");
    $adresse = readline ("Entrer l'adresse de l'agence : ");
    $code = (rand(100,999));
    
    if (filesize("./bdd/agence.csv") == 0 ) {
        arrayToCsv("./bdd/agence.csv", $header);
        $tabagence= [$code, $nom, $adresse];
        arrayToCsv("./bdd/agence.csv", $tabagence);
    }
    else{
        for($i=0; $i<count($listeAgences)-1; $i++){
            if($listeAgences[$i][0] == $code){
                $code = rand(100, 999);
                $i = -1;
            }
        }
        $tabagence= [$code, $nom, $adresse];
        arrayToCsv("./bdd/agence.csv", $tabagence);
    }
}


?>
