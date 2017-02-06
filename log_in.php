<?php
	session_start();
	include 'conn.inc.php';
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Login</title>
      <link href="menu.css" rel="stylesheet" />
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
      <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
      <!-- Form per login -->
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
                     if($stm->rowCount() == 1)
                     {
								echo '<script type="text/javascript">alert("ACCESSO");</script>';
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
