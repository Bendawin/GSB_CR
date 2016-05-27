<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_visiteur extends CI_Model {

    function __construct()
    {
        // Appelle le constructeur du modèle
        parent::__construct();

		// Chargement du modèle d'accès aux données utile à toutes les méthodes
		$this->load->model('dataaccess');
    }

	/**
	 * Accueil du visiteur:
	 * 
	 * La fonction intègre un mécanisme de contrôle d'existence des fiches de frais sur les 6 derniers mois. 
	 * Si l'une d'elles est absente, elle est créée.
	*/
    
	public function accueil($message=null)	// Charge la page d'accueil
	{	
		if($message != null){
			echo $message;
			sleep(5);
			$message = null;
			
		}
		$this->templates->load('t_visiteur', 'v_visAccueil');
	}
	
	/**
	 * Liste des comptes rendus existants
	 *
	 * 
	 * @param $message : message facultatif destiné à notifier l'utilisateur du résultat d'une action précédemment exécutée
	 */
	
	public function voirCR ($idUser , $message=null)	// Fonction permettant de consulter les comptes-rendus
	{	    
		$idUser = $this->session->userdata('idUser');		
		$data['notify'] = $message;
		$data['mesCR'] = $this->dataaccess->getLesCR($idUser);
		$data['idUser'] = $idUser;

		$this->templates->load('t_visiteur', 'v_visVoirCR', $data);
	}
	
	/**
	 * Ajouter un compte rendu
	 *
	 * @param $idUser : l'id du visiteur
	 * @param $mois : le mois de la fiche à modifier
	 */

	public function ajouterCR()	// Fonction permettant d'ajouter des comptes-rendus
	{			
		$data['lesMedic']= $this->dataaccess->getLesMedic();
		$data['lesPratic']= $this->dataaccess->getLesPratic();
		$this->templates->load('t_visiteur', 'v_ajouterCR', $data);
	}
}