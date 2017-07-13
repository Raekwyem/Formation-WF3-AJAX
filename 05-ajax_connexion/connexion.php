<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Connexion</title>
	</head>
	<body>
		<div class="container">
	        <form method="POST" action="" id="form">

		            <label for="pseudo">Pseudo</label>
		            <input type="text" name="pseudo" id="pseudo">


		            <label for="mdp">Mot de passe</label>
		            <input type="text" name="mdp" id="mdp">

		            <button type="submit" name="connect" id="connect">Se connecter</button>

	        </form>
	        <hr>
	        <div id="resultat"></div>
		</div> <!-- fermeture CONTAINER -->
		<script>
			// on récupère l'élément html qui a l'id form et on rajoute un évènement (la soumission du formulaire) puis on déclenche une fonction sur cet évènement qui bloque la soumission du formulaire (bloque le rechargement de page)
			document.getElementById('form').addEventListener("submit",
				function(e){
					// on bloque la soumission du formulaire // .preventDefault() permet de bloquer l'évènement quel qu'il soit
					e.preventDefault();
					// on exécute notre fonction déclarée à l'extérieur de l'évènement qui lancera la requête ajax
					ajax();
			});
			// déclaration d'une fonction js nous permettant de lancer une requête ajax
			function ajax(){
				// déclaration du nom du fichier cible qui devra être exécuté lors de la requête ajax
				var file = 'ajax.php';
				// vérification pour la compatibilité navigateur si XMLHttpRequest existe sur ce navigateur
				if(window.XMLHttpRequest)
					var xhttp = new XMLHttpRequest(); // pour la plupart des navigateurs
				else
					// sinon c'est un navigateur IE ancien et c'est ActiveXObject qui devra être utilisé
					var xhttp = new ActiveXObject("Microsoft.XMLHTTP"); // pour explorer
				// on récupère l'élément qui a l'ID pseudo et on le place dans la variable p
				var p = document.getElementById("pseudo");
				var pseudo = p.value; // récupération de la valeur du pseudo
				console.log('Pseudo: ' + pseudo);

				var m = document.getElementById("mdp");
				var mdp = m.value; // récupération de la valeur du pseudo
				console.log('Mdp: ' + mdp);

				// parametres - mise en place d'une chaine de caratères représentant les paramètres que nous allons transmettre à ajax.php sous la forme indice=valeur&indice2=valeur2&indice3=valeur3
				var param = "pseudo="+pseudo+"&mdp="+mdp;
				console.log(param);
				// on ouvre la requête ajax en mode post, en fournissant le fichier cible concerné par la requête ajax représenté par file en mode true (asynchrone)
				xhttp.open("POST", file, true);
				//on transmet à notre requête ajax un header http obligatoire lorsque nous utilisons la methode post
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				// mise en place de l'évènement qui va se déclencher à chaque changement de statut de la requête ajax
				// on test le statut de la requête ajax ainsi que le statut http
				xhttp.onreadystatechange = function(){

					if(xhttp.readyState == 4 && xhttp.status == 200)
					{
						// .responseText représente la réponse fournie par notre requête ajax
						console.log(xhttp.responseText);
						// si on récupère une chaine de caractères au format JSON, nous devons utiliser JSON.parse() afin d'en créer un objet js
						var reponse = JSON.parse(xhttp.responseText);
						// .resultat correspond à l'indice défini en php sur ajax.php
						// on place donc la réponse dans l'élément html prévu à cet effet
						document.getElementById('resultat').innerHTML = reponse.resultat;
					}
				}
				// cette ligne déclenche l'envoi de la requête ajax en fournissant les paramètres attendus sur ajax.php
				xhttp.send(param); // on envoie avec les parametres (personne=valeur)
			}

		</script>
	</body>
</html>