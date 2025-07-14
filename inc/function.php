<?php
function dbconnect() {
    static $connect = null;
    if ($connect === null) {
        $connect = mysqli_connect('localhost', 'root', '', 'objet');
        if (!$connect) {
            die("Erreur de connexion à la base de données : " . mysqli_connect_error());
        }
    }
    return $connect;
}
 
function insert($nom, $email, $mdp, $naissance, $genre, $ville) {
    $conn = dbconnect();
    $sql = "INSERT INTO membre (nom, email, mdp, date_naissance, genre, ville) VALUES ('$nom', '$email', '$mdp', '$naissance', '$genre', '$ville' )";
    
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        echo "Erreur d'insertion : " . mysqli_error($conn);
        return false;
    }
}

function liste_objet(){
    return $sql = mysqli_query(dbconnect(),"SELECT * from v_liste_objet where date_retour is not null"); 
}

// function getMembre($idMembre){
//     $conn = dbconnect();
//     $sqlMembres = "SELECT id_membre, nom, email FROM membre WHERE id_membre != '$idMembre'";
//     $result = mysqli_query($conn, $sqlMembres);
//     return $result;
// }

// function getTableAmis($idMembre, $idmembres = [] ) {
//     $conn = dbconnect();
//     $sql = "SELECT * from amis 
//             Where idMembre1 = '$idMembre' and idMembre2 = '$idmembres' and DateHeureAcceptation != null
//             UNION SELECT idMembre2,idMembre1,DateHeureDemande,DateHeureAcceptation from amis 
//             where idMembre2 = '$idMembre' and idMembre1 = '$idmembres' and DateHeureAcceptation != null";
//     $result = mysqli_query($conn, $sql);
//     return $result;
// }

?>
