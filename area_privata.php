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
		<nav align = "center">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="#">Profilo</a>
					<ul>
						<li><a href="log_out.php">Log Out</a></li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- Form -->
		<div align="center">
			<form align="left">
				<select>
					<?php
						$mysqli = new mysqli("localhost","root","","RegistrazioneUtenti");
						$query = $mysqli->query("SELECT idCategoria,NomeCategoria FROM Categoria");
						while($row=$query->fetch_row()){                                                 
							echo "<option value='".$row[0]."'>".$row[1]."</option>";
						}
					?>
				</select>
			</form>
			<div class="promos">  
				<div class="promo">
					<div class="deal">
						<span>Abbigliamento</span>
					</div>
					<span class="price">$79</span>
					<ul class="features">
						<li>Some great feature</li>
						<li>Another super feature</li>
						<li>And more...</li>   
					</ul>
					<button>Acquista</button>
				</div>
				<div class="promo scale">
					<div class="deal">
						<span>Alimentari</span>
					</div>
					<span class="price">$89</span>
					<ul class="features">
						<li>Some great feature</li>
						<li>Another super feature</li>
						<li>And more...</li>   
					</ul>
					<button>Acquista</button>
				</div>
				<div class="promo">
					<div class="deal">
						<span>Tecnologia</span>
					</div>
					<span class="price">$69</span>
					<ul class="features">
						<li>Choose the one on the left</li>
						<li>We need moneyy</li>
						<li>And more...</li>   
					</ul>
					<button>Acquista</button>
				</div>
				</div>
		</div>
		
	</body>
</html>