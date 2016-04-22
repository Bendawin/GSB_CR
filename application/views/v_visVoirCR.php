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
	foreach( $mesCR as $unCR)
	{
		
		echo
			'<tr>
				<td>'.$unCR['numero'].'</td>
				<td>'.$unCR['date'].'<td>
				<td>'.$unCR['dateVisite'].'<td>
				<td>'.$unCR['motif'].'<td>
				<td>'.$unCR['practicien'].'<td>
			</tr>';
	}
	?>
	</tbody>
</table>





</div>

