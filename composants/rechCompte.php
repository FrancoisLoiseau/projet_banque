<?

function rechCompte() {

$num_compte=readline ("Entrer votre n° de compte : ");
$listeCompte1=null;
$listeCompte2=null;
$listeCompte3=null;

if (($fichier=fopen("./bdd/compte.csv","r"))!==false) {
    while(($data=fgetcsv($fichier,1000,";"))!==false) {
        $i=1;
        if($data[0]==$num_compte) {
            $compte=[$data[1],$data[2],$data[3],$data[4],$data[5]];
            if ($i==1) {
                $listeCompte1=$compte;
            }
            if ($i==2) {
                $listeCompte2=$compte;
            }
            if ($i==3) {
                $listeCompte3=$compte;
            }
            
            if ($i==3) {
                break;
            }

            $i++;

        }
    }
    fclose ($fichier);

}

if ($listeCompte1 == null && $listeCompte2 == null && $listeCompte3 == null)  {
    echo("Aucun compte trouvé !\n");
}
elseif
     ($listeCompte3 !==null)  {
      
        print_r ($listeCompte1);
        print_r ($listeCompte2);
        print_r ($listeCompte3);
    }

 elseif
    ($listeCompte3 ==null) {
        print_r ($listeCompte1);
        print_r ($listeCompte2);
    }

 else {
        print_r ($listeCompte1);
    }
      
}
?>