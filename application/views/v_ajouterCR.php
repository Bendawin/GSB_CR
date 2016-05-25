
<?php
	$this->load->helper('url');
?>
<html><head>
	<title>formulaire RAPPORT_VISITE</title>
	<style type="text/css">
		 body { margin-left: 100px; } 
		label.titre { width : 180 ;  clear:left; float:left; } 
		.zone { width : 30car ; float : left; color:5599EE }
		
	</style>
	<script language="javascript">
		function selectionne(pValeur, pSelection,  pObjet) {
			//active l'objet pObjet du formulaire si la valeur sélectionnée (pSelection) est égale à la valeur attendue (pValeur)
			if (pSelection==pValeur) 
				{ formRAPPORT_VISITE.elements[pObjet].disabled=false; }
			else { formRAPPORT_VISITE.elements[pObjet].disabled=true; }
		}
	</script>
	 <script language="javascript">
        function ajoutLigne( pNumero){//ajoute une ligne de produits/qté à la div "lignes"     
			//masque le bouton en cours
			document.getElementById("but"+pNumero).setAttribute("hidden","true");	
			pNumero++;										//incrémente le numéro de ligne
            var laDiv=document.getElementById("lignes");	//récupère l'objet DOM qui contient les données
			var titre = document.createElement("label") ;	//crée un label
			laDiv.appendChild(titre) ;						//l'ajoute à la DIV
			titre.setAttribute("class","titre") ;			//définit les propriétés
			titre.innerHTML= "   Produit : ";
			var liste = document.createElement("select");	//ajoute une liste pour proposer les produits
			laDiv.appendChild(liste) ;
			liste.setAttribute("name","PRA_ECH"+pNumero) ;
			liste.setAttribute("class","zone");
			//remplit la liste avec les valeurs de la première liste construite en PHP à partir de la base
			liste.innerHTML=formRAPPORT_VISITE.elements["PRA_ECH1"].innerHTML;
			var qte = document.createElement("input");
			laDiv.appendChild(qte);
			qte.setAttribute("name","PRA_QTE"+pNumero);
			qte.setAttribute("size","2"); 
			qte.setAttribute("class","zone");
			qte.setAttribute("type","text");
			var bouton = document.createElement("input");
			laDiv.appendChild(bouton);
			//ajoute une gestion évenementielle en faisant évoluer le numéro de la ligne
			bouton.setAttribute("onClick","ajoutLigne("+ pNumero +");");
			bouton.setAttribute("type","button");
			bouton.setAttribute("value","+");
			bouton.setAttribute("class","zone");	
			bouton.setAttribute("id","but"+ pNumero);				
        }
    </script>
</head>
<body>

<div id = "contenu">

<div name="droite" style="float:left;width:80%;">
	<div name="bas" style="margin : 10 2 2 2;clear:left; height:88%;">
		<form name="formRAPPORT_VISITE" method="post" action="recupRAPPORT_VISITE">
			<h1> Rapport de visite </h1>
			
	<!-- NUMERO -->
		<!-- <p> Votre numéro de compte rendu est le </p> --> 
	
	<!-- DATE VISITE -->
			<label class="titre">Date Visite : </label><input type="date" size="10" name="RAP_DATEVISITE" class="zone" /> 
			
	<!-- PRATICIEN -->
			<label class="titre">Praticien : </label><select  name="PRA_NUM" class="zone" >
			
				<?php 
						$indice = 1;
						for ($i = 0; $i < count($lesPratic) ; $i++)
						{
							echo '<option value="'.$lesPratic[$i]['code'].'">'.$lesPratic[$i]['nom'] .' '.$lesPratic[$i]['prenom'] .'</option>';
							$indice += 1;
						} 
					?> 
				</select>
				
	<!--COEFFICIENT -->		
			<!--  <label class="titre">Coefficient : </label><input type="text" size="6" name="PRA_COEFF" class="zone" /> -->
			
	<!-- REMPLACANT -->	
			<label class="titre">Remplaçant : </label><input type="checkbox" class="zone" name = "REMP_CHECK" onClick="selectionne(true,this.checked,'PRA_REMPLACANT');"/>
				<select name="PRA_REMPLACANT" disabled="disabled" class="zone" >
					<?php 
						$indice = 1;
						for ($i = 0; $i < count($lesPratic) ; $i++)
						{
							echo '<option value="'.$lesPratic[$i]['code'].'">'.$lesPratic[$i]['nom'] .' '.$lesPratic[$i]['prenom'] .'</option>';
							$indice += 1;
						} 
					?> 
				</select>
	
	<!-- DATE -->
		<!--<label class="titre">Date : </label><input type="text" size="19" name="RAP_DATE" class="zone" />-->
		
	<!-- MOTIF -->
			<label class="titre">Motif : </label><select  name="RAP_MOTIF" class="zone" onClick="selectionne('AUT',this.value,'RAP_MOTIFAUTRE');">
											<option value="PRD">Périodicité</option>
											<option value="ACT">Actualisation</option>
											<option value="REL">Relance</option>
											<option value="SOL">Sollicitation praticien</option>
											<option value="AUT">Autre</option>
										</select><input type="text" name="RAP_MOTIFAUTRE" class="zone" disabled="disabled" />
										
										
										
	<!-- BILAN -->								
			<label class="titre">Bilan : </label><textarea rows="5" cols="50" name="RAP_BILAN" class="zone" ></textarea>
			
	<!-- ELEMENTS PRESENTES -->		
			<label class="titre" ><h3> Eléments présentés </h3></label>
			
			
	<!-- PRODUIT 1 -->
			<label class="titre" >Produit 1 : </label><select name="PROD1" class="zone">
				<?php $indice = 1;
						for ($i = 0; $i < count($lesMedic) ; $i++)
						{
							echo '<option value="'.$lesMedic[$i]['code'].'">'.$lesMedic[$i]['medicament'].'</option>';
							$indice += 1;
						} 
				?> 
			</select>
			
																			
	<!-- PRODUIT 2 -->									
			<label class="titre" >Produit 2 : </label><select name="PROD2" class="zone">
				<?php 
						$indice = 1;
						for ($i = 0; $i < count($lesMedic) ; $i++)
						{
							echo '<option value="'.$lesMedic[$i]['code'].'">'.$lesMedic[$i]['medicament'].'</option>';
							$indice += 1;
						} 
				?> 
			</select>
			
			
	<!-- DOCUMENT OFFERT -->	
			<label class="titre">Documentation Offerte : </label>
				<input name="RAP_DOC" type="checkbox" class="zone" />
		
	<!-- ECHANTILLONS -->
			<label class="titre"><h3>Echantillons </h3></label>
			
			<div class="titre" id="lignes">
				<label class="titre" >Produit : </label>
				<select name="PRA_ECH1" class="zone">
					<?php 
						$indice = 1;
						for ($i = 0; $i < count($lesMedic) ; $i++)
						{
							echo '<option value="'.$lesMedic[$i]['code'].'">'.$lesMedic[$i]['medicament'].'</option>';
							$indice += 1;
						} 
					?> 
				</select>
				<input type="text" name="PRA_QTE1" size="2" class="zone"/>
				<input type="button" id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />			
			</div>	
				
			<label class="titre">Saisie Définitive : </label><input name="RAP_LOCK" type="checkbox" class="zone" />

			

			
	<!-- BTN VALIDER ANNULER -->
			<label class="titre"></label>
				<div class="zone">
					<input type="reset" value="Annuler"></input>
					<input type="submit"  value="Valider"></input>
				</div>
		</form>
	</div>
</div>
</div>

</body>
</html>

