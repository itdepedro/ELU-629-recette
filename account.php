<?php include 'includes/server.php' ?>
<?php include 'includes/functions.php' ?>

<?php if (!isset($_SESSION['username'])){ 
	header("Location:error.php");
	die();
}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Mon compte</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
</head>
<body class="is-preload">

	<div id="wrapper">
		<div id="main">
			<div class="inner">
				<?php include 'includes/header.php';?>

				<section>
					<header class="major">
						<h2>Mon profil</h2>
					</header>

					<p>Vous pouvez modifier vos informations de base.</p>

					<?php
					$user = getUser($_SESSION['userid']);
					?>

					<form method="post" action="account.php" >
						<?php include 'includes/errors.php'; ?>
						<div class="row gtr-uniform">
							<div class="col-6 col-12-xsmall">
								<h3>Utilisateur:</h3>
								<input type="text" name="username" id="demo-name" value="<?php echo($user['username']); ?>" placeholder="Utilisateur" disabled />
							</div>
							<div class="col-6 col-12-xsmall">
								<h3>Email:</h3>
								<input type="email" name="email" id="demo-email" value="<?php echo($user['email']); ?>" placeholder="Email" />
							</div>
							<div class="col-6 col-12-xsmall">
								<h3>Mot de passe:</h3>
								<input type="password" name="password_1" id="demo-email" value="" placeholder="Mot de passe" />
							</div>
							<div class="col-6 col-12-xsmall">
								<h3>Mot de passe:</h3>
								<input type="password" name="password_2" id="demo-email" value="" placeholder="Mot de passe" />
							</div>

							<div class="col-12">
								<ul class="actions">
									<li><input type="submit" value="Sauvegarder" class="primary" name="update_user"/></li>
								</ul>
							</div>
						</div>
					</form>
				</section>

			</div>
		</div>

		<?php include 'includes/sidebar.php';?>

	</div>

	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

</body>
</html>