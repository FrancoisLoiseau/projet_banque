<?

function creerAgence(){

    $tabagence = ["code_agence", "nom", "adresse"];
    $filename = "./bdd/agence.csv";
    
    $nom = readline ("Entrer le nom de l'agence : ");
    $adresse = readline ("Entrer l'adresse de l'agence : ");
    $code = (rand(100,999));
    
    if (filesize($filename) == 0 ) {
        $fichier = fopen($filename , "a+");
        fputcsv($fichier, $tabagence,";");
        $tabagence= [$code, $nom, $adresse];
        fputcsv($fichier, $tabagence,";");
        fclose($fichier);
    }
    else{
        $listeAgences = csvToArray($filename);
        for($i=0; $i<count($listeAgences)-1; $i++){
            if($listeAgences[$i][0] == $code){
                $code = rand(100,999);
                $i = -1;
            }
        }
        $fichier = fopen($filename , "a+");
        $tabagence= [$code, $nom, $adresse];
        fputcsv($fichier, $tabagence,";");
        fclose($fichier);
    }
}


?>
