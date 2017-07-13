<?php
require_once("inc/init.inc.php");

$tab = array();
$tab['tableau'] = '';

$table = $pdo->query("SELECT * FROM employes");

$tab['tableau'] .= "<table border='1'><tr>";

$nb_col = $table->ColumnCount();
for($i = 0; $i < $nb_col; $i++)
{
	$colonne = $table->getColumnMeta($i);
	$tab['tableau'] .= '<th>' . $colonne['name'] . '</th>';
}

while($ligne = $table->fetch(PDO::FETCH_ASSOC))
{
	$tab['tableau'] .= '<tr>';

	foreach($ligne AS $valeur)
	{
		$tab['tableau'] .= '<td>' . $valeur . '</td>';
	}

	$tab['tableau'] .= '</tr>';
}

$tab['tableau'] .= '</tr>';
$tab['tableau'] .= '</table>';
echo json_encode($tab);