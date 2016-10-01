<?php
	
	/*
	var_dump($_GET);
	echo "<br>";
	var_dump($_POST);
	*/
	
require ("../../config.php");
require("functions.php");
if (isset ($_SESSION["userId"])) {
	header("Location: data.php");
	}
	
	$signupemailerror = "";
	$signuppassworderror = "";
	$signupemail = "";
	$signupnickname = "";
	$loginemail = "";
	$loginemailerror = "";
	$loginpassworderror = "";
	$signupnicknameerror = "";
	
	//Kas e-post oli olemas?
	if (isset ($_POST["signupemail"]))
		{
			if (empty ($_POST["signupemail"]))
				{
					//tühi
					$signupemailerror = "See väli on kohustuslik.";
				}
				else
				{
					$signupemail = $_POST["signupemail"];
				}
		
		}
	if (isset ($_POST["signupnickname"]))
		{
			if (empty ($_POST["signupnickname"]))
				{
					$signupnicknameerror = "See väli on kohustuslik.";
				}
				else 
				{		
					if (strlen ($_POST["nickname"]) <8)
					{
						$nicknameerror = "Kasutajanimi peab olema vähemalt 8 tähemärkki pikk";	
					}
				}
		}
	if (isset ($_POST["signuppassword"]))
		{
			if (empty ($_POST["signuppassword"]))
				{
					
					$signuppassworderror = "See väli on kohustuslik.";
				}
				else
				{
					//Kontrollin pikkust
					if (strlen($_POST["signuppassword"]) < 8)
					{
						$signuppassworderror = "Parool peab olema vähemalt 8 tähemärki pikk.";
					}
				}
		}
			if (isset($_POST["signuppassword"])&&
		isset ($_POST["signupemail"])&&
		isset ($_POST["nickname"])&&
		empty ($signupemailerror)&& 
		empty ($signuppassworderror)&&
		empty ($nicknameerror))
		{
		
		echo "Salvestan...<br>";
		echo "email".$signupemail. "<br>";
		echo "password ".$_POST["signuppassword"]."<br>";
		echo "nickname" .$_POST["nickname"]."<br>";
		
		$password = hash ("sha512", $_POST["signuppassword"]);
		
		echo "parool".$_POST["signuppassword"]."<br>";
		echo "räsi".$password."<br>";
		}
				
				
			
		
				$database = "if16_anna";
			
				$mysqli = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
			
				$stmt = $mysqli->prepare("INSERT INTO user_sample (email,password,nickname) VALUES (?, ?, ?)");
				echo $mysqli->error;
			//s stringi
			//i integer
			//d double/float
				$stmt->bind_param("sss", $signupmail, $password, $signupnickname);
		
	if ($stmt->execute()){
			echo "Salvestamine õnnestus";
		}else {
			echo "Viga ".$stmt->error;
		$stmt->close();
		$mysqli->close();
		}
	
	if (isset ($_POST["loginemail"]))
		{
			if (empty ($_POST["loginemail"]))
				{
					
					$loginemailerror = "See väli on kohustuslik.";
				}
		}
	
	if (isset ($_POST["loginpassword"]))
		{
			if (empty ($_POST["loginpassword"]))
				{
					
					$loginpassworderror = "See väli on kohustuslik.";
				}
				else 
				{
					if (strlen($_POST["loginpassword"]) < 8)
					{
					$loginpassworderror = "Parool peab olema vähemalt 8 tähemärki pikk.";
					}
				}
		}
		$error = "";
	// kontrollin, et kasutaja täitis välja ja võib sisse logida
	if ( isset($_POST["loginemail"]) &&
		 isset($_POST["loginpassword"]) &&
		 !empty($_POST["loginemail"]) &&
		 !empty($_POST["loginpassword"])
	  ) {
		
		//login sisse
		$error = login($_POST["loginemail"], $_POST["loginpassword"]);
		
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Sisselogimise lehekülg</title>
	</head>
	<body bgcolor = "#C1FFFD">
	<style>	
		body {
			background-image:	url("http://orig02.deviantart.net/b294/f/2014/266/1/d/braum_render_by_void_zormak-d809wg3.png");
			background-repeat: no-repeat;
			background-position: right bottom;
			background-attachment: fixed;
			}
	</style>


		<h1><font color = "blue">Sign in</font></h1>
		<form method = "POST">
			<!--<label>E-post</label><br>-->
			<input name="loginemail" type = "email" placeholder="Email" value ="<?php echo $loginemail; ?>"><?php echo $loginemailerror; ?>
			<br><br>
			<input name="loginpassword" type = "password" placeholder="Password"> <?php echo $loginpassworderror; ?>
			<br><br>
			<input type="submit" value="Sign in">
		</form>

	</body>
</html>

<h1><font color = "blue">Sign up</font></h1>
		<form method = "POST">
			<!--<label>E-post</label><br>-->
			<input name="signupemail" type = "email" placeholder="Email" value ="<?php echo $signupemail; ?>"><?php echo $signupemailerror; ?>
			<br><br>
			<input name="signuppassword" type="password" placeholder="Password"><?php echo $signuppassworderror; ?>
			<br><br>
			<input name ="nickname" type = "text" placeholder = "Nickname" value ="<?php echo $signupnickname; ?>"><?php echo $signupnicknameerror; ?>
			
		<p>
			<b><font color = "blue">Gender</font></b>
			
		<p>
		
			<select name="sugu">
			<option value="1" selected= "selected">male</option>
			<option value="2">female</option>
			<option value="3">other</option>
			</select>
		<p>
		
			<input type="submit" value="Sign up">
		</form>
		
		<html>
		<body>
		<h1><font color = "blue">MVP idee</font></h1>
		<p>
	    <i><b>League of legends art community</b></i>
		<p>
		<i>Veebileht inimestele, kes on huvitatud arvutimängust League of Legends ja joonistavad/harrastavad sellega seotuid fan art'e.
		<p> on võimalus lisada enda joonistusi, hinnata teiste fan art'e.
		<p> On ka olemas kommenteerimise võimalus,paremuse lehekülg, portfolio loomise võimalus.</i>
		</body>
		</html>
	