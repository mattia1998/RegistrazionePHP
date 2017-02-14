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
			<div class="container">
				<form class="well form-horizontal" action=" " method="post"  id="contact_form">
					<fieldset>

				  		<!-- Form Name -->
						<legend>Contact Us Today!</legend>

						<!-- Text input-->

						<div class="form-group">
						  <label class="col-md-4 control-label">First Name</label>  
						  <div class="col-md-4 inputGroupContainer">
						  <div class="input-group">
						  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						  <input  name="first_name" placeholder="First Name" class="form-control"  type="text">
							 </div>
						  </div>
						</div>

					<!-- Text input-->

					 <div class="form-group">
						 <label class="col-md-4 control-label" >Last Name</label> 
						 <div class="col-md-4 inputGroupContainer">
						 <div class="input-group">
					  	 <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
					  	 <input name="last_name" placeholder="Last Name" class="form-control"  type="text">
						 </div>
					  </div>
					</div>
				<!-- Text input-->

				 <div class="form-group">
					  <label class="col-md-4 control-label">City</label>  
						 <div class="col-md-4 inputGroupContainer">
						 <div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
					  <input name="city" placeholder="city" class="form-control"  type="text">
						 </div>
					  </div>
				</div>

				<!-- Select Basic -->

				<div class="form-group"> 
				  <label class="col-md-4 control-label">State</label>
					 <div class="col-md-4 selectContainer">
						 <div class="input-group">
							  <span class="input-group-addon"><i class="glyphicon glyphicon-list"></i></span>
						 <select name="state" class="form-control selectpicker" >
							<option value=" " >Please select your state</option>
							<option>Alabama</option>
							</select>
						</div>
					</div>
				</div>
				<!-- Success message -->
				<div class="alert alert-success" role="alert" id="success_message">Success <i class="glyphicon glyphicon-thumbs-up"></i> Thanks for contacting us, we will get back to you shortly.</div>

				<!-- Button -->
				<div class="form-group">
				  	<label class="col-md-4 control-label"></label>
				  		<div class="col-md-4">
					 	<button type="submit" class="btn btn-warning" >Send <span class="glyphicon glyphicon-send"></span></button>
				  		</div>
					</div>
				</fieldset>
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
							print_r($stm);
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