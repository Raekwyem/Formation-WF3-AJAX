<?php
$tab = array();
$tab['resultat'] = "";

if(!empty($_POST['pays']))
{
	// exercice: renvoyer dans $tab['resultat'] les villes selon la valeur de l'indice pays
	// sous forme '<option>ville1</option><option>ville2</option>'

	if($_POST['pays'] == 'France')
	{
		$tab['resultat'] = '<option>Paris</option>
							<option>Bordeaux</option>
							<option>Toulouse</option>';
	}
	elseif ($_POST['pays'] == 'USA') {
		$tab['resultat'] = '<option>San Francisco</option>
							<option>Las Vegas</option>
							<option>New York</option>';
	}
	elseif ($_POST['pays'] == 'Canada') {
		$tab['resultat'] = '<option>Montréal</option>
							<option>Edmonton</option>
							<option>Vancouver</option>';
	}
}
echo json_encode($tab);