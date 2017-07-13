<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Connect</title>
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="contenu">
			<fieldset>
				<div id="message">
				<!-- mettre en place une requête ajax déclenchée lors de la validation du formulaire. Récupérer les paramètres à fournir puis tester si la communication est ok. Si vous recevez bien la réponse depuis ajax_connexion.php -->
				Veuillez vous connecter
				</div>
			</fieldset>
			<fieldset>
				<form method="post" action="#" id="form">
				<!-- dans ce formulaire: 4 champs + bouton submit (pseudo/sexe/ville/date_de_naissance) -->
					<label for='pseudo'>Pseudo</label>
					<input type="text" name="pseudo" id="pseudo" value="">
					<br>
					<label for="sexe">Sexe</label>
					<select name="sexe" id="sexe">
						<option value="m">Homme</option>
						<option value="f">Femme</option>
					</select>
					<br>
					<label for="ville">Ville</label>
					<input type="text" name="ville" id="ville" value="">
					<br>
					<label for="date_de_naissance">Date de naissance</label>
					<input type="date" name="date_de_naissance" id="date_de_naissance" value="" placeholder="AAAA/MM/JJ">
					<br>
					<input type="submit" value="Connexion au chat!">
				</form>
			</fieldset>
		</div>
		<script>
		// on récupère l'élément action et on ajoute lors de l'évènement clic le déclenchement d'une fonction
			document.getElementById("form").addEventListener("submit", function(e){

				e.preventDefault();

				ajax();
			});
			function ajax(){
				// récupération des données
				var champPseudo = document.getElementById("pseudo");
				var pseudo = champPseudo.value;
				var champSexe = document.getElementById("sexe");
				var sexe = champSexe.value;
				var champVille = document.getElementById("ville");
				var ville = champVille.value;
				var champDateDeNaissance = document.getElementById("date_de_naissance");
				var DateDeNaissance = champDateDeNaissance.value;
				
				var param = "pseudo="+pseudo+"&sexe="+sexe+"&ville="+ville+"&date_de_naissance="+DateDeNaissance;
				console.log(param);

				// déclaration du fichier cible
				var file = "ajax_connexion.php";

				if(window.XMLHttpRequest)
					var xhttp = new XMLHttpRequest();
				else
					var xhttp = new ActiveXObject("Microsoft.XMLHTTP");

				xhttp.open("POST", file, true);
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

				xhttp.onreadystatechange = function(){

					if(xhttp.readyState == 4 && xhttp.status == 200)
					{
						console.log(xhttp.responseText);
						var reponse = JSON.parse(xhttp.responseText);
						document.getElementById("message").innerHTML = reponse.resultat;

						if(reponse.pseudo == 'disponible'){
							// si la valeur de l'indice pseudo est 'disponible' alors je sais qu'il n'y a pas eu d'erreur et on redirige sur dialogue.php
							window.location.href = 'dialogue.php';
						}
					}
				}
				xhttp.send(param);
			}
	</script>
	</body>
</html>