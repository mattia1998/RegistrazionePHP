<?php
	include 'conn.inc.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Registrazione</title>
		<!-- CSS -->
		<link href="menu.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600' rel='stylesheet' type='text/css'>
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">
		<link href="registrazione.css" rel="stylesheet" />
      <!-- Funzioni JAVASCRIPT -->
		<script type="text/javascript">	
			function registrazioneAvvenuta(){
				alert("REGISTRAZIONE AVVENUTA !");
			}
         
         function erroreCampi(){
            alert("RIEMPIRE TUTTI I CAMPI !");
         }
         
		</script>
	</head>
	<body>
		
		<body bgcolor = "00BFFF"/>
		<!-- Menu per navigazione--> 
		<nav align = "center">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Area Privata</a>
					<ul>
						<li><a href="log_in.php">Accedi</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		
		<br/>
		<!-- Form per registrazione-->
		<center>
			<div class="testbox">
			  <h1>Registrazione</h1>

			  <form action="/" method="POST">
				<hr>
				<label id="icon" for="name"><i class="icon-user"></i></label>
				<input type="text" name="username" id="name" placeholder="Username" required/>
				  <!-- -->
				<label id="icon" for="name"><i class="icon-user"></i></label>
				<input type="text" name="nome" id="name" placeholder="Nome" required/>
				  <!-- -->
				<label id="icon" for="name"><i class="icon-user"></i></label>
				<input type="text" name="cognome" placeholder="Cognome" required/>
				  <!-- -->
				<label id="icon" for="name"><i class="icon-user"></i></label>
				<input type="text" name="citta" id="name" placeholder="Citta'" required/>
				  <!-- -->
				<label id="icon" for="name"><i class="icon-user"></i></label>
				<input type="text" name="stato" id="name" placeholder="Stato" required/>
				  <!-- -->
				<label id="icon" for="name"><i class="icon-shield"></i></label>
				<input type="password" name="password" id="name" placeholder="Password" required/>
				  <!-- -->
				<label id="icon" for="name"><i class="icon-shield"></i></label>
				<input type="date" name="dataNascita" id="dataNascita" placeholder="Data" required/>
				<!-- -->
				  <input type="submit" name="cerca" value="Registrati" id="button_registrati">
			</form>
		</div>
				<!-- PHP -->
				<?php 
					if(isset($_POST['username']))
					{
						try
						{
							$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db, $username, $password);

							if($_POST['username']=="" OR $_POST['password']=="" OR $_POST['nome']=="" OR $_POST['cognome']="" OR $_POST['citta']=="" OR $_POST['stato']=="") {
								echo '<script type="text/javascript">erroreCampi();</script>';
							}
							else {
								$stm = $dbh->prepare("INSERT INTO Utenti(Username,Password,Nome,Cognome,DataNascita,Citta,Stato) VALUES(:user,:passwd,:nome,:cognome,:dataN,:citta,:stato)");
								$stm->bindValue(':user',$_POST['username']);
								$pw = md5($_POST['password']);
								$stm->bindValue(':passwd',$pw);
								$stm->bindValue(':nome',$_POST['nome']);
								$stm->bindValue(':cognome',$_POST['cognome']);
								$stm->bindValue(':dataN',$_POST['dataNascita']);
								$stm->bindValue(':citta',$_POST['citta']);
								$stm->bindValue(':stato',$_POST['stato']);
								$stm->execute();
								//$row = $stm->fetch();
								//print_r($row[0]);
								//print_r($stm);
								if($stm->errorCode() == 0)
								{
									echo '<script type="text/javascript">registrazioneAvvenuta()</script>';
									header('Location:area_privata.php');
								}
								else
								{
									echo 'Errore nella Query';
								}
							}
						}
						catch (PDOException $e) 
						{
							echo 'Errore con la connessione al Database';
						}
				}
				?>

				<br/><br/>
		</center>
	</body>
</html>