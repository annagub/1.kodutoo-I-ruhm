<?php
require ("../../config.php");
require("functions.php");

if (isset ($_SESSION["userId"])) {
		
		header("Location: data.php");
		
	}
	// var_dump (empty)
	//var_dump ($_GET);
	//echo "<br>";
	//var_dump ($_POST);
	$signupemailerror = "";
	$signuppassworderror = "";
	$signupemail = "";
	$nickname = "";
	$loginemail = "";
	$loginemailerror = "";
	$loginpassworderror = "";
	$nimierror = "";
	//kas epost oli olemas
	
	if(isset ($_POST["signupemail"])){
		
		if (empty ($_POST["signupemail"])){
			
			// oli email, kuid see oli tühi
			$signupemailerror = "See väli on tühi";
		} else {
			// email on õige, salvestan väärtuse muutujasse
			$signupemail = $_POST["signupemail"];	
		}
	}

	if(isset ($_POST["signuppassword"])){
		if (empty ($_POST["signuppassword"])){
			$signuppassworderror = "See väli on tühi";
		} else {
			//tean et oli parool ja ei olnud tühi.
			//vähemalt 8
			if (strlen($_POST["signuppassword"]) < 8) {
				$signuppassworderror = "Parool peab olema vähemalt 8 tähemärkki pikk";
			}
		}	
	}
	if(isset ($_POST["nickname"])){
		
		if (empty ($_POST["nickname"])){
			
			
			$nimierror = "See väli on tühi";
		} else {
			
			$nickname = $_POST["nickname"];	
		}
	}
	
	if(isset ($_POST["loginemail"])){
		
		if (empty ($_POST["loginemail"])){
			
			// oli email, kuid see oli tühi
			$loginemailerror = "See väli on tühi";
		} else {
			// email on õige, salvestan väärtuse muutujasse
			$loginemail = $_POST["loginemail"];
			
		}
	}

	if(isset ($_POST["loginpassword"])){
		if (empty ($_POST["loginpassword"])){
			$loginpassworderror = "See väli on tühi";
		} else {
			//tean et oli parool ja ei olnud tühi.
			//vähemalt 8
			if (strlen($_POST["loginpassword"]) < 8) {
				$loginpassworderror = "Parool peab olema vähemalt 8 tähemärkki pikk";
			}
		}	
	}
	// Tean et ühtegi viga ei olnud ja saan kasutaja anmed salvestada
	if (isset($_POST["signuppassword"])&&
		isset ($_POST["signupemail"])&&
		empty ($signupemailerror)&& 
		empty ($signuppassworderror))
		{
		
		echo "Salvestan...<br>";
		echo "email".$signupemail. "<br>";
		
		$password = hash ("sha512", $_POST["signuppassword"]);
		
		echo "parool".$_POST["signuppassword"]."<br>";
		echo "räsi".$password."<br>";
		signup($signupemail, $password);
	}
	
	$error = "";
	// kontrollin, et kasutaja täitis välja ja võib sisse logida
	if ( isset($_POST["loginEmail"]) &&
		 isset($_POST["loginPassword"]) &&
		 !empty($_POST["loginEmail"]) &&
		 !empty($_POST["loginPassword"])
	  ) {
		
		//login sisse
		$error = login($_POST["loginEmail"], $_POST["loginPassword"]);
		
	}
	
		
		
		
		//echo $serverUsername;
		//echo $serverPassword;
		//ühedus
		$database = "if16_anna";
		$mysqli = new mysqli ($serverHost, $serverUsername, $serverPassword, $database);
		//käsk
		$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES (?,?)");
		//asendan ?,? väärtustega
		//iga muutuja kohta 1 täht, mis tüüpi muutuja on
		//s - string
		//i - integer
		//d - double/float
		$stmt->bind_param("ss", $signupemail, $password);
		if ($stmt->execute()){
			echo "salvestamine õnnestus";
		}else {
			echo "ERROR".$stmt->error;
		
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
			<input name ="nickname" type = "text" placeholder = "Nickname" value ="<?php echo $nickname; ?>"><?php echo $nimierror; ?>
			
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
	