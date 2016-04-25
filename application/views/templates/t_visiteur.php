<?php
	$this->load->helper('url');
	$v_path = base_url('application/views');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

	<head>
		<title>Intranet du Laboratoire Galaxy-Swiss Bourdin</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<link href="<?php echo $v_path.'/templates/css/styles.css'?>" rel="stylesheet" type="text/css" />

		<script language="JavaScript">
			function hideNotify() {
				document.getElementById("notify").style.display = "none";
			}
		</script>
		
	</head>

	<body onload="setTimeout(hideNotify,7000);">
	
		<div id="page">
			<div id="entete">
				<img src="<?php echo $v_path.'/templates/images/logo.jpg'?>" id="logoGSB" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin" />
				<h1>Gestion des frais de déplacements</h1>
				
										
						
				
			</div>
		
			<!-- Division pour le menu -->
			<div id="menuGauche">
				<div id="infosUtil">
					<h2>ceci est une information utile</h2>
				</div>  
				
				<ul id="menuList">
					<li>
						Visiteur :<br/>
						<?php echo $this->session->userdata('prenom')."  ".$this->session->userdata('nom');  ?>
					</li>
					<br/>
					<li class="smenu">
						<?php echo anchor('c_visiteur/', 'Accueil', 'title="Page d\'accueil"'); ?>
					</li>
					<li class="smenu">
						<?php echo anchor('c_visiteur/ajouterCR', 'Ajouter un compte rendu', 'title="Ajouter un compte rendu"'); ?>
					</li>
					<li class="smenu">
						<?php echo anchor('c_visiteur/mesFiches', 'Voir les comptes rendus', 'title="Consultation des comptes rendus"'); ?>
					</li>
					<br/>
					<li class="smenu">
						<?php echo anchor('c_visiteur/deconnecter', 'Se déconnecter', 'title="Déconnexion"'); ?>
					</li>
				</ul>
				
			</div>
			</span>
	

			<?php echo $body; ?>

			<div id="pied">
			<marquee>
				Bienvenue sur le site GSB best site ever in Paris! Attention: nous sommes des pros!
			</marquee>
				<br/>
			</div>

		</div>    

	</body>
</html>

	  