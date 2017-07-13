<?php
$pdo = new PDO('mysql:host=localhost;dbname=connexion', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

$pseudo = (isset($_POST['pseudo'])) ? $_POST['pseudo'] : "";
$mdp = (isset($_POST['mdp'])) ? $_POST['mdp'] : "";

/*
écriture classique:
if(isset($_POST['pseudo']))
{
	$pseudo = $_POST['pseudo'];
}
else{
	$pseudo = "";
}
 */
// déclaration d'un tableau array qui contiendra notre réponse à la requête ajax
$tab = array();
// déclaration de l'indice dans le tableau array qui contiendra la réponse, c'est cet indice que l'on appelle dans l'évènement onreadystatechange:
$tab['resultat'] = "";

// Exo:
// faire le contrôle si le pseudo et le mot de passe correspond à une entrée de la BDD
// s'il y a une erreur: renvoyer une chaine de caractères annonçant l'erreur à l'utilisateur si le pseudo et le mdp sont ok, envoyer un message du type "Vous êtes connecté, vous êtes ... de sexe ..., votre adresse mail est: ..."

$result = $pdo->prepare("SELECT * FROM utilisateur WHERE pseudo = :pseudo AND mdp = :mdp");
$result->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
$result->bindParam(":mdp", $mdp, PDO::PARAM_STR);
$result->execute();

// on vérifie le nb de ligne dans la réponse de la BDD
// s'il y a moins d'une ligne alors le pseudo ou le mdp ou les deux sont faux
if($result->rowCount() < 1)
{
	$tab['resultat'] = "Erreur sur le pseudo ou le mot de passe. Veuillez recommencer";	
}
else
{
	$utilisateur = $result->fetch(PDO::FETCH_ASSOC);

	$sexe = ($utilisateur['sexe'] == 'm') ? 'masculin' : 'féminin';

	// alors le pseudo et le mdp son correct
	$tab['resultat'] = "Vous êtes connecté, vous êtes " . $utilisateur['pseudo'] . ", de sexe " . $sexe . ", votre adresse mail est: " . $utilisateur['email'];
}

// envoi de la réponse en encodant sous le format JSON:
echo json_encode($tab);

