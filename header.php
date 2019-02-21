<header id="header">
	<a href="./" class="logo"><img class="logo" src="images/logo.png" alt="International Catering" /></a>

	<div class="login">
		<?php  if (isset($_SESSION['username'])) : ?>
			<div class="row gtr-uniform">
				<div class="col-12" style="text-align: right;">
					<p>Bienvenu <strong><?php echo $_SESSION['username']; ?></strong></p>
					<a href="index.php?logout='1'" style="color: red;">Fermer la session</a>
				</div>
			</div>
		<?php  else: ?>
			<form method="post" action="index.php">
				<?php include 'includes/errors.php'; ?>
				<div class="row gtr-uniform">

					<div class="col-6 col-12-xsmall">
						<input type="text" name="username" placeholder="Utilisateur" maxlength="50">
					</div>
					<div class="col-6 col-12-xsmall">
						<input type="password" name="password" placeholder="Mot de passe" maxlength="50">
					</div>

					<div class="col-12">
						<ul class="actions">
							<li><button type="submit" class="btn" name="login_user">S'identifier</button></li>
							<li>Pas encore membre? <a href="register.php">S'inscrire</a></li>
						</ul>
					</div>
				</div>
			</form>
		<?php endif ?>
	</div>
</header>