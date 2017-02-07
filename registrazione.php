<?php
	include 'conn.inc.php';
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Registrazione</title>
		<link href="menu.css" rel="stylesheet" />
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
		
		<br/><br/><br/><br/><br/>
		<!-- Form per registrazione-->
		<center>
			<fieldset>
				<legend>
					Registrati
				</legend>
				<form id="reg" action="" method="POST">
					<table>
						<tr>
							<td><b>Username:</b></td>
							<td><input type="text" name="username" id="input_user"></td>
						</tr>
						<tr>
							<td><b>Password:</b></td>
							<td><input type="password" name="password" id="input_psw"></td>
						</tr>
						<tr>
							<td><b>Nome:</b></td>
							<td><input type="text" name="nome" id="input_user"></td>
						</tr>
						<tr>
							<td><b>Cognome:</b></td>
							<td><input type="text" name="cognome" id="input_user"></td>
						</tr>
						<tr>
							<td><b>Data di Nascita:</b></td>
							<td><input type="date" name="dataNascita" id="input_user"></td>
						</tr>
						<tr>
							<td><b>Città:</b></td>
							<td><input type="text" name="citta" id="input_user"></td>
						</tr>
						<tr>
							<td><b>Stato:</b></td>
							<td><input type="text" name="stato" id="input_user"></td>
						</tr>			
					</table>
					<br/><br/>
               <input type="submit" name="btnInvia" value="Invia" id="submit_button">
				</form>
			</fieldset>
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