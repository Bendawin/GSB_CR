<?php
	$this->load->helper('url');
?>

<div id = "contenu">
<h2>Liste des comptes rendu</h2>

<?php if(!empty($notify)) echo '<p id="notify" >'.$notify.'</p>';?>

<table class = "listelegere">
	<thead>
		<tr>
			<th> Numéro </th>
			<th> Date </th>
			<th> Date Visite </th>
			<th> Motif </th>
			<th> Practicien </th>
			
		</tr>
	</thead>
	
	<tbody>
	
	<?php
	
	
		$indice = 1;
		for ($i = 0; $i < count($mesCR) ; $i++)
		{
		echo
			'<tr>
				<td>'.$mesCR[$i]['numero'].'</td>
				<td>'.$mesCR[$i]['date'].'<td>
				<td>'.$mesCR[$i]['dateVisite'].'<td>
				<td>'.$mesCR[$i]['motif'].'<td>
				<td>'.$mesCR[$i]['practicien'].'<td>
			</tr>';
			$indice += 1;
		}
	?>
	</tbody>
</table>





</div>

	

