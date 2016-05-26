<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Contrôleur du module VISITEUR de l'application
*/
class C_visiteur extends CI_Controller
{

	/**
	 * Aiguillage des demandes faites au contrôleur
	 * La fonction _remap est une fonctionnalité offerte par CI destinée à remplacer 
	 * le comportement habituel de la fonction index. Grâce à _remap, on dispose
	 * d'une fonction unique capable d'accepter un nombre variable de paramètres.
	 *
	 * @param $action : l'action demandée par le visiteur
	 * @param $params : les éventuels paramètres transmis pour la réalisation de cette action
	*/
	public function _remap($action, $params = array())
	{
		// Chargement du modèle d'authentification
		$this->load->model('authentif');
		
		// Contrôle de la bonne authentification de l'utilisateur
		if (!$this->authentif->estConnecte()) 
		{
			// Si l'utilisateur n'est pas authentifié, on envoie la vue de connexion
			$data = array();
			$this->templates->load('t_connexion', 'v_connexion', $data);
		}
		
		else
		{
			// Aiguillage selon l'action demandée 
			// CI a traité l'URL au préalable de sorte à toujours renvoyer l'action "index",
			// même lorsqu'aucune action n'est exprimée
			
			// index demandé : on active la fonction accueil du modèle visiteur
			if ($action == 'index')				
			{
				$this->load->model('a_visiteur');

				// on n'est pas en mode "modification d'une fiche"
				// $this->session->unset_userdata('mois');

				$this->a_visiteur->accueil();
			}
	
			elseif ($action == 'ajouterCR')
			{
				$this->load->model('a_visiteur');
				// $data['lesMedic'] = $this->dataaccess->getLesMedic();
				$this->a_visiteur->ajouterCR();				
			}			
			
			elseif ($action == 'voirCR')	// voirCR demandé : on active la fonction voirCR du modèle a_visiteur
			{
				$this->load->model('a_visiteur');
				$this->a_visiteur->voirCR('$idUser');			
			}
			
			elseif ($action == 'deconnecter')	// déconnecter demandé : on active la fonction déconnecter du modèle authentif
			{
				$this->load->model('authentif');
				$this->authentif->deconnecter();
			}
			
			elseif ($action == 'recupRAPPORT_VISITE')
			{
				$date = $_POST['RAP_DATEVISITE'];
				$praticien = $_POST['PRA_NUM'];
				
				if (isset($_POST['REMP_CHECK']))
				{
					$praticien = $_POST['PRA_REMPLACANT'];
				}
			
				if ($motif = $_POST['RAP_MOTIF'] == 'AUT')
				{
					$motif = $_POST['RAP_MOTIFAUTRE'];
				}
				
				$bilan = $_POST['RAP_BILAN'];
				$produit1 = $_POST['PROD1'];
				$produit2 = $_POST['PROD2'];	
				$nbechant = $_POST['COMP'];	
				$echantillons = array($_POST['PRA_ECH1']);
				$qte = array($_POST['PRA_QTE1']);
				$this->load->model('dataaccess');	
				$this->dataaccess->insertData($date, $praticien, $motif, $bilan, $produit1, $produit2);
				
				for($i=1 ; $i<$nbechant ; $i++)
				{
					array_push($echantillons, $_POST['PRA_ECH'.$i]);
					array_push($qte, $_POST['PRA_QTE'.$i]);					
					$this->dataaccess->insertEchant($praticien,(string)$echantillons[$i],(string)$qte[$i],$date);
				}			
			}
			
			else	// Dans tous les autres cas, on envoie la vue par défaut pour l'erreur 404
			{
				show_404();
			}
		}
	}
}
