<?php include 'includes/functions.php' ?>

<!DOCTYPE HTML>
<?php 
session_start(); 

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: index.php");
}
?>
<?php include 'includes/server.php';?>
<html>
<head>
	<title>Page d'accueil</title>

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
						<h2>Dernières recettes publiées</h2>
					</header>
					<div class="posts">
						<?php
						$recettes = getLastsRecettes();
						while ($rec = $recettes->fetch_assoc()) {
							$idRecette = $rec['id'];
							?>

							<article>
								<a href='<?php echo ('./recette.php?idRecette=' . $rec['id']) ?>' class="image"><img src='<?php echo ('img/' . $rec['photo']) ?>' /></a>
								<h3><?php echo($rec['titre']); ?></h3>
								<p><?php $date = new DateTime($rec["date"]);
                                    echo "Publié le ".$date->format('d-m-Y');?></p>
								<ul class="actions">
									<li><a href='<?php echo ('./recette.php?idRecette=' . $rec['id']) ?>' class="button">Lire</a></li>
								</ul>
							</article>

							<?php
						}
						?>
					</div>
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