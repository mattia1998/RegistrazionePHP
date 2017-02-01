<?php
	session_start();
	include 'conn.inc.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link href="menu.css" rel="stylesheet" />
</head>
<body>
	<body bgcolor = "00BFFF"/>
	
	<nav align = "center">
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="registrazione.php">Registrati</a></li>
			<li><a href="#">Area Privata</a>
				<ul>
					<li><a href="log_in.php">Accedi</a></li>
				</ul>
			</li>
		</ul>
	</nav>
	<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		<center>
			<form id="login" action="" method="POST">
				<table>
					<tr>
						<td><b>Username:</b></td>
						<td><input type="text" name="username"></td>
					</tr>
					<tr>
						<td><b>Password:</b></td>
						<td><input type="password" name="password"></td>
					</tr>
				</table>
				<br/>
				<input type="submit" name="invia" value="Invia"><br/><br/>
			</form>

			<?php 
				if(isset($_POST['username']))
				{
					try
					{
						$dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db, $username, $password);
						$stm = $dbh->prepare("SELECT * FROM users WHERE username = :user AND password = :passwd");
						$stm->bindValue(':user',$_POST['username']);
						$pw = md5($_POST['password']);
						$stm->bindValue(':passwd',$pw);
						$stm->execute();
						if($stm->rowCount() == 1)
						{
							echo '<form action="#" method="POST">
									<input type="submit" name="areaP" value="Accedi all\'Area Personale">
								  </form>';
						}
						else
						{
							echo 'Dati errati<br/>';
						}
					}
					catch(PDOException $e)
					{
						echo 'Errore nella connessione al DataBase<br/>';
					}
				}
			?>

			<br/>
		</center>
</body>
</html>
