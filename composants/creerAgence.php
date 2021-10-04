<?

function creerAgence(){

    $tabagence = ["code", "nom", "adresse"];
    $filname = "./bdd/agence.csv";
    
    $nom = readline ("Entrer le nom de l'agence : ");
    $adresse = readline ("Entrer l'adresse de l'agence : ");
    $code = (rand(100,999));
    
    $var = fopen($filname , "a+");
    
    if (filesize($filname) == 0 ) {
        fputcsv($var, $tabagence,";");
        $tabagence= [$code, $nom, $adresse];
        fputcsv($var, $tabagence,";");
        fclose($var);
    }
    else{
        $tab=[];
        $tab_code=[];
    
        while(($row=fgetcsv($var, 1000, ";"))!=false) {
            $tab[]= $row;
        }
    
        for($i=1; $i<count($tab); $i++) {
            $tab_code[] = $tab[$i][0];
        }
    
        for($i=0; $i<count($tab_code); $i++) {
            if($code==$tab_code[$i]) {
                $code=(rand(100,999));
                $i=0;
            }
        }
        $tabagence= [$code, $nom, $adresse];
        fputcsv($var, $tabagence,";");
    
        fclose($var);
    }
}








?>
