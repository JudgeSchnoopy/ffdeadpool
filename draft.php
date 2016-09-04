<!DOCTYPE HTML>
<html>
	<head>
		<title>Admin Draft</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="landing2">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<nav id="nav">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li>
								<a href="" class="icon fa-angle-down">Info</a>
								<ul>
									<li><a href="rules.html">Rules</a></li>
									<li><a href="score.php">Scores</a></li>
									<li><a href="contact.html">Contact</a></li>
									<li><a href="http://www.nfl.com/injuries" target="_blank">NFL.com Injury Report</a></li>
								</ul>
							</li>
							<li><a href="" class="button">Sign Up</a></li>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner" class="score">
					<h2>Add a new athlete, assign to team</h2>
				</section>
			
<!-- Main -->
	<section id="main" class="container 80%">
<?php
$username = "jgolden";
$password = "webform";
$nonsense = "HeyRyanReynoldsisactuallyaprettygoodactorOK";
$server = "localhost";
$user = "drafter";
$dbpassword = "ryanreynolds";
$db = "NFLDeadpool";
$link = new mysqli($server, $user, $dbpassword, $db);
	if ($link->connect_error) {
		die("Bummer dude SQL connection error: " . $link->connect_error); }

if (isset($_COOKIE['PrivatePageLogin'])) {
   if ($_COOKIE['PrivatePageLogin'] == md5($password.$nonsense)) {
?>
		<section class="box">
										
			<form action="<?php echo $_SERVER['PHP_SELF']?>?p=athlete" method="post">
				FirstName: <input type="text" class="styled" name="FirstName">
				LastName: <input type="text" class="styled" name="LastName">
				Team: <input type="text" class="styled" name="Team">
				Position: <input type="text" class="styled" name="Position">
				TeamName: <select name="TeamID">
				<?php $findteams = $link->query("SELECT TeamID, TeamName from Teams");
					while ($row = $findteams->fetch_assoc()) {
						unset($TeamID, $TeamName);
						$TeamID = $row['TeamID'];
						$TeamName = $row['TeamName'];
						echo '<option value="'.$TeamID.'">'.$TeamName.'</option>';
					} ?>
				</select>
				Bonus: <select name="Bonus">
					<option value='1'> 1 </option>
					<option value='1.5'> 1.5 </option>
					<option value='2'> 2 </option>
				</select><br>
				<input type="submit" id="formsubmit" value="formsubmit">
			</form>
			
<?php	if (isset($_GET['p']) && $_GET['p'] == "athlete") {
				echo "A thing happened!";
				$FirstName = $_POST['FirstName'];
	   			$LastName = $_POST['LastName'];
	   			$Team = $_POST['Team'];
	   			$Position = $_POST['Position'];
	   			$TeamID = $_POST['TeamID'];
				$Bonus = $_POST['Bonus'];
						
				$playeraction = "INSERT INTO athletes (FirstName, LastName, Team, Position, InjuryScore)
							VALUES ('$FirstName', '$LastName', '$Team', '$Position',DEFAULT)";
				$athlete = $link->query($playeraction);
						echo "athlete crammed into athletes table!";
				$AthleteIDcheck = "SELECT AthleteID FROM athletes WHERE FirstName='$FirstName' AND LastName='$LastName' AND Team='$Team' AND Position='$Position'";
						echo $AthleteIDcheck;
				$AthleteID = $link->query($AthleteIDcheck);
						$row = $AthleteID->fetch_assoc();
				$teamaction = "INSERT INTO Roster VALUES ('$TeamID', " . $row['AthleteID'] . ", '$Bonus',0)";
						echo $teamaction;
				$draft = $link->query($teamaction);
				echo 'Roster position drafted';
				$link->close();
}
		else {
			echo "Not a submit page"; }
?>	
		</section>
<?php
      exit;
   } else {
      echo "Bad Cookie.";
      exit;
   }
}

if (isset($_GET['p']) && $_GET['p'] == "login") {
   if ($_POST['user'] != $username) {
      echo "Sorry, that username does not match.";
      exit;
   } else if ($_POST['keypass'] != $password) {
      echo "Sorry, that password does not match.";
      exit;
   } else if ($_POST['user'] == $username && $_POST['keypass'] == $password) {
      setcookie('PrivatePageLogin', md5($_POST['keypass'].$nonsense));
      header("Location: $_SERVER[PHP_SELF]");
   } else {
      echo "Sorry, you could not be logged in at this time.";
   }
}
?>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>?p=login" method="post">
<label><input type="text" name="user" id="user" />Username</label><br />
<label><input type="password" name="keypass" id="keypass" /> Password</label><br />
<input type="submit" id="submit" value="Login" />
</form>
		
	</section>
			
			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
						<li><a href="#" class="icon fa-google-plus"><span class="label">Google+</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; ffdeadpool by Judge Schnoopy. All rights reserved.</li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollgress.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
