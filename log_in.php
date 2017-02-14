<?php
	session_start();
	include 'conn.inc.php';
?>

<!DOCTYPE html>
<html>
   <head>
      <title>Login</title>
      <link href="menu.css" rel="stylesheet" />
		  <link href="login.css" rel="stylesheet" />
		  <script type="text/javascript" src="login.js"></script>
      <!-- Funzioni JAVASCRIPT -->
      <script type="text/javascript">
         function erroreDati() {
            alert("ERRORE NELL'INSERIMENTO DEI DATI OPPURE UTENTE NON REGISTRATO");
         }
      </script>
		
   </head>
   <body>
      <body bgcolor = "00BFFF"/>
      <!-- Menu per navigazione -->
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
      <br/>
      <!-- Form per login -->
         <center>
				<div class="wrapper">
					<form class="login" action="" method="POST">
						<p class="title">Log in</p>
							<input type="text" placeholder="Username" name ="username"autofocus/>
							<i class="fa fa-user"></i>
							<input type="password" placeholder="Password" name="password"/>
							<i class="fa fa-key"></i>
							<button>
							<i class="spinner"></i>
							<span class="state">Log in</span>
							</button>
					</form>
				</div>
            <!-- PHP -->
            <?php 
               if(isset($_POST['username']))
               {
                  try
                  {
                     $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $db, $username, $password);
                     $stm = $dbh->prepare("SELECT * FROM Utenti WHERE Username = :user AND Password = :passwd");
                     $stm->bindValue(':user',$_POST['username']);
                     $pw = md5($_POST['password']);
                     $stm->bindValue(':passwd',$pw);                                                                                                                                                       
                     $stm->execute();
										$row = $stm->fetch();
										//print_r($row[0]);
                    if($stm->rowCount() == 1) {
											$_SESSION['id'] = $row[0];
											header('Location:area_privata.php');
                     }
                     else
                     {
                        echo '<script type="text/javascript">erroreDati();</script>';
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
