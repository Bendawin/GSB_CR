<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Modèle qui implémente les fonctions d'accès aux données 
*/
class DataAccess extends CI_Model
{
	
    function __construct()
    {
        // Appelle le modèle du constructeur
        parent::__construct();
    }

    /**
	 * Retourne les informations d'un visiteur
	 * 
	 * @param $login 
	 * @param $mdp
	 * @return l'id, le nom et le prénom sous la forme d'un tableau associatif 
	*/
    
    // Récupère dans la base de données les informations (id, nom, prénom) des visiteurs correspondant à leurs login et mdp et les renvoie dans un tableau.
	public function getInfosVisiteur($login, $mdp)
	{
		$req = "SELECT visiteur.VIS_MATRICULE as id, visiteur.VIS_NOM as nom, visiteur.VIS_PRENOM as prenom
				FROM visiteur
				WHERE visiteur.LOGIN='". $login ."' and visiteur.MDP= '" . $mdp ."'" ;
		$rs = $this->db->query($req, array ($login, $mdp, $id));
		$ligne = $rs->first_row('array'); 
		return $ligne;
	}	
	
	/**
	 * Retourne tous les comptes rendus
	 *
	 * @return un tableau associatif contenant les comptes rendus
	 */
	
	// Récupère les informations concernant les comptes-rendus (bilan, date de visite, motif de la visite, numéro de rapport, nom du praticien) et les renvoie dans un tableau.
	 public function getLesCR($idUser)	
	 {	 
	 	$req = "SELECT RAP_BILAN as bilan, RAP_DATE as dateVisite, RAP_MOTIF as motifVisite, RAP_NUM as numero, PRA_NUM as praticien
	 			FROM rapport_visite
	 			WHERE VIS_Matricule = '" . $idUser . "'
	 			ORDER BY RAP_DATE desc";
	 	$rs = $this->db->query($req);
	 	$mesCR = $rs->result_array();
	 	return $mesCR;
	 } 
	
	 // Récupère les informations concernant les médicaments (code, nom commercial) dans la base de données et les renvoie dans un tableau.
	 public function getLesMedic()	
	 {
	 	$req = "SELECT medicament.MED_DEPOTLEGAL as code, medicament.MED_NOMCOMMERCIAL as medicament
	 			FROM medicament
	 			ORDER BY MED_NOMCOMMERCIAL";
	 	$rs = $this->db->query($req);
	 	$lesMedic = $rs->result_array() ;
	 	return $lesMedic;
	 }
	 
	 // Récupère les informations concernant les praticiens (code, prénom, nom) dans la base de données et les renvoie dans un tableau.
	 public function getLesPratic()
	 {
	 	$req = "SELECT PRA_NUM as code, PRA_PRENOM as prenom, PRA_NOM as nom
	 			FROM praticien
	 			ORDER BY PRA_NOM";
	 	$rs = $this->db->query($req);
	 	$lesPratic =$rs->result_array() ;
	 	return $lesPratic;
	 }
	 
	 // Insère dans la base de données les informations saisies dans le formulaire (sauf échantillons) par le visiteur.
	 public function insertData($date, $praticien, $motif, $bilan, $produit1, $produit2)
	 {
	 	$matricule = $this->session->userdata('idUser');
	 	$req = "INSERT INTO rapport_visite(vis_matricule, pra_num, rap_date, rap_bilan, rap_motif)
	 			VALUES ('$matricule', '$praticien', '$date', '$bilan', '$motif')";
	 	$rs = $this->db->query($req);
	 }
	 
	 // Insère dans la base de données les noms commerciaux et quantités d'échantillons insérés dans le formulaire par le visiteur.
	 public function insertEchant($praticien, $medic, $qte, $date)
	 {
	 	$matricule = $this->session->userdata('idUser');
	 	$requ = "SELECT RAP_NUM 
	 		  	 FROM rapport_visite
	 		  	 WHERE VIS_MATRICULE = '$matricule' AND PRA_NUM = '$praticien' AND RAP_DATE = '$date'";
	 	$rs = $this->db->query($requ);
	 	$rapport = $rs->first_row('array'); 
	 	foreach($rapport as $rap){
	 	$rapnum=$rap;
	 	}	 	
	 	$medic = $medic;
	 	$qte = $qte;
	 	
	 	$req = "INSERT INTO offrir(VIS_MATRICULE, RAP_NUM, MED_DEPOTLEGAL, OFF_QTE) 
	 			VALUES ('$matricule','$rapnum','$medic','$qte')";
		$rs2 = $this->db->query($req);	 	
	 }
}
?>