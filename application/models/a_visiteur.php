<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class A_visiteur extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();

		// chargement du modèle d'accès aux données qui est utile à toutes les méthodes
		$this->load->model('dataaccess');
    }

	/**
	 * Accueil du visiteur
	 * La fonction intègre un mécanisme de contrôle d'existence des 
	 * fiches de frais sur les 6 derniers mois. 
	 * Si l'une d'elle est absente, elle est créée
	*/
	public function accueil()
	{	// TODO : Charge la page d'accueil
	
		$this->templates->load('t_visiteur', 'v_visAccueil');
	}
	
	/**
	 * Liste des comptes rendu existant
	 *
	 * 
	 * @param $message : message facultatif destiné à notifier l'utilisateur du résultat d'une action précédemment exécutée
	 */
	public function voirCR ($idUser , $message=null)
	{	// TODO : s'assurer que les paramètres reçus sont cohérents avec ceux mémorisés en session
	    
		$idUser = $this->session->userdata('idUser');		
		$data['notify'] = $message;
		$data['mesCR'] = $this->dataaccess->getLesCR($idUser);
		$data['idUser']=$idUser;

		$this->templates->load('t_visiteur', 'v_visVoirCR', $data);
	}
	
	/**
	 * Ajouter un compte rendu
	 *
	 * @param $idUser : l'id du visiteur
	 * @param $mois : le mois de la fiche à modifier
	 */

	public function ajouterCR()
	{	
		
		$data['lesMedic']= $this->dataaccess->getLesMedic();
		$data['lesPratic']= $this->dataaccess->getLesPratic();
		/* $data['numauto']= $this->dataaccess->getNumAuto(); */
		$this->templates->load('t_visiteur', 'v_ajouterCR', $data);
	}
}