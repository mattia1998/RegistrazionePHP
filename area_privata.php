<?php
	include 'conn.inc.php';
	session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Area Privata</title>
		<link href="menu.css" rel="stylesheet" />
		<link href="tabella.css" rel="stylesheet" />
	</head>
	<body>	
		<body bgcolor = "00BFFF"/>
		<!-- Menu -->
		<div align="center">
			<nav align = "center">
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="#">Profilo</a>
					</li>
				</ul>
			</nav>
		</div>
		<!-- Form -->
		<br>
		<br>
		<br>
		<!<div align="left">
			<form align="left" method="POST">
				<select name="categoria" onchange="submit()">
					<?php
						$mysqli = new mysqli("localhost","root","","RegistrazioneUtenti");
						$query = $mysqli->query("SELECT idCategoria,NomeCategoria FROM Categoria");
						while($row=$query->fetch_row()) {  
							if($_POST['categoria'] == $row[0]) {
								echo "<option value='".$row[0]."' selected='selected'>".$row[1]."</option>"
							}
							else 
							{
								echo "<option value='".$row[0]."'>".$row[1]."</option>";
							}
						}
					?>
				</select>
			</form>
		</div>
		<div>
      <?php
		  $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db, $username, $password);
		  $stm = $dbh->prepare("SELECT * FROM Prodotti WHERE idCategoria = ". $_POST['categoria']);
		  $stm->execute();
		  
		  if($stm->rowCount() > 0)
        {
          while($result = $stm->fetch())
          {
				 echo '
			<div class="promos">
				<div class="promo scale">
					<div class="deal">
						<span>'. $result["NomeProdotto"] .'</span>
					</div>
					<span class="price">'. '&euro; ' . $result['PrezzoProdotto'] .'</span>
					<ul class="features">
					</ul>
					<button>Acquista</button>
				</div>
			</div>';
          }
        }
      ?>
    </div>
		<!--
			<div class="promos">
				<div class="promo">
					<div class="deal">
						<span>Abbigliamento</span>
					</div>
					<span class="price">$79</span>
					<ul class="features">
					</ul>
					<button>Acquista</button>
					</div>
					<div class="promo scale">
						<div class="deal">
							<span>Alimentari</span>
						</div>
						<span class="price">$89</span>
						<ul class="features">
						</ul>
						<button>Acquista</button>
					</div>
					<div class="promo">
						<div class="deal">
							<span>Tecnologia</span>
						</div>
						<span class="price">$30</span>
						<ul class="features">  
						</ul>
						<button>Acquista</button>
					</div>
				</div>
		-->
	</body>
</html>