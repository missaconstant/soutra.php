<?php
/**#################################################################
    SOUTRA.PHP , PHP CRUD creator
    Copyright (C) 2016  FABLAB AYIYIKOH, www.ayiyikoh.org
    SOUTRA.PHP is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    SOUTRA.PHP is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with SOUTRA.PHP.  If not, see <http://www.gnu.org/licenses/>.
		fablab@ayiyikoh.org

####################################################################**/
session_start();
$_SESSION['declared'] = false ;

	include 'moteur/functions/creerModeles.php' ;
	include 'moteur/functions/creerClasses.php' ;
	include 'moteur/functions/config.php' ;

	if(isset($_POST['server'])){

		sleep(1);
		execute($_POST) ;

	}

	else if(strtolower(php_sapi_name())=='cli' && empty($_SERVER['remote_addr'])){

		include 'moteur/bienvenue.php' ;

		$handle = array() ;
		$continue = true ;

		do{
			echo "Veuillez renseigner les informations suivantes:\n";
			$handle['server'] = scan("Adresse du serveur") ;
			$handle['bd'] = scan("Nom de la base de données") ;
			$handle['user'] = scan("Utilisateur de la base de données") ;
			$handle['pass'] = scan("Mot de passe de l'utilisateur de la base de données ",true) ;
			execute($handle) ;

			$reponse = scan("Avez vous une autre application à générer ? O/N") ;
			$continue = (strtolower($reponse)=='o') ? true : false ;
		}
		while($continue) ;

		print("\n\nFermeture de soutra ...\n\n") ;
		session_destroy() ;
		sleep(2) ;
		system("exit") ;
	}



	function execute($infos){
		try {

			$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION ;
			$bd = new PDO('mysql:dbname='.$infos['bd'].';host='.$infos['server'],$infos['user'],$infos['pass'],$pdo_options) ;

			$_SESSION['folder'] = date("d-m-Y_His_").$infos['bd'] ;

			/* creation du dossier applications si celui ci n'existe pas dejà */
			if(!is_dir('applications')) @mkdir('applications') ;
				@mkdir('applications/'.$_SESSION['folder']) ;

			/* creation fichier de connexion à la base de données */
			if(!is_dir('applications/'.$_SESSION['folder'].'/configurations')){
				@mkdir('applications/'.$_SESSION['folder'].'/configurations') ;
				$f = fopen('applications/'.$_SESSION['folder'].'/configurations/connexionBD.php','w+') ;
				fclose($f) ;
				file_put_contents('applications/'.$_SESSION['folder'].'/configurations/connexionBD.php', creerConnexion($infos['server'],$infos['bd'],$infos['user'],$infos['pass'])) ;
			}

			$_SESSION['folder'] = 'applications/'.$_SESSION['folder'] ;

				include 'moteur/generateurClasses.php' ;
				include 'moteur/generateurModeles.php' ;

			echo "application générée avec succès !\n" ;

		} catch (Exception $e) {
			echo (strtolower(php_sapi_name())=='cli' && empty($_SERVER['remote_addr'])) ? "\n\n\e[31mUne erreur s'est produite verifiez les informations entrées.\e[0m \n\n" : json_encode(["error" => true, "message" => "An error occured ! Are provided informations right ?"]) ;
		}
	}

	function scan($msg,$password=false){
		print($msg." : ") ;
		if($password==true){
			system("stty -echo") ;
				$pass = trim(fgets(STDIN)) ;
			system("stty echo") ;
			return $pass ;
		}
		else{
			return trim(fgets(STDIN)) ;
		}
	}