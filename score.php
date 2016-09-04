<!DOCTYPE HTML>
<html>
	<head>
		<title>ffdeadpool scores</title>
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
								<a href="#" class="icon fa-angle-down">Info</a>
								<ul>
									<li><a href="rules.html">Rules</a></li>
									<li><a href="score.php">Scores</a></li>
									<li><a href="contact.html">Contact</a></li>
									<li><a href="http://www.nfl.com/injuries" target="_blank">NFL.com Injury Report</a></li>
								</ul>
							</li>
							<li><a href="#" class="button">Sign Up</a></li>
						</ul>
					</nav>
				</header>

			<!-- Banner -->
				<section id="banner" class="score">
					<h2>Current Scores</h2>
					<p>Showing scores for the beta league</p>
				</section>
			
			<!-- Main -->
				<section id="main" class="container 75%">

			<section class="box score">
										
			<?php
				$server = "localhost";
				$user = "web";
				$password = "webform";
				$db = "NFLDeadpool";
				$link = new mysqli($server, $user, $password, $db);
					if ($link->connect_error) {
						die("Bummer dude SQL connection error: " . $link->connect_error); }
				$findteam = "SELECT * FROM Teams JOIN Players ON Teams.PlayerID = Players.PlayerID";
				if ($teamnum = $link->query($findteam)){
					$teamrow = $teamnum->num_rows;
					if ($teamrow > 0) {
					while ($row = $teamnum->fetch_assoc()) {
						$allinfo = "SELECT * from Players JOIN Teams ON Players.PlayerID = Teams.PlayerID JOIN Roster ON Teams.TeamID = Roster.TeamID JOIN athletes ON Roster.AthleteID = athletes.AthleteID WHERE Teams.TeamID = " . $row['TeamID'];
						
						if ($printer = $link->query($allinfo)) {
							$row_cnt = $printer->num_rows;
								echo "<table border='1'>";
									echo "<caption style='text-align:left;'>&nbsp&nbsp" . $row['TeamName'] . " : &nbsp&nbsp" . $row['TeamScore'] . "<span style='float:right;'>Manager:  " . $row['PlayerName'] . "</span></caption>";
									echo "<tr>";
										echo "<th width='30%'>Athlete</th>";
										echo "<th width='25%'>Team</th>";
										echo "<th width='15%'>Score</th>";
										echo "<th width='15%'>Bonus</th>";
										echo "<th width='15%'>deadpool</th>";
									echo "</tr>";
							if ($row_cnt > 0) {
								while ($row = $printer->fetch_assoc()) {
	
								echo "<tr>";
									echo "<td>" . $row['FirstName'] . " " . $row['LastName'] . "</td>";
									echo "<td>" . $row['Team'] . "</td>";
									echo "<td>" . $row['InjuryScore'] . "</td>";
									echo "<td>" . $row['Bonus'] . "</td>";
									echo "<td>" . $row['Points'] . "</td>";
								echo "</tr>";
								}
							}
						else {
							echo "No results for this team.  Sorry.";
						}
					
						echo "</table>";}}}}
						$link->close();
					?>
					
					<?php  ?>
							
				</section>
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
