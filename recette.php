<?php include 'includes/server.php' ?>
<?php include 'includes/functions.php' ?>

<?php 
$idRct = $_GET["idRecette"];
$row_cnt = count(getRecette($idRct));
if ((isset($_GET["idRecette"])) && ($row_cnt > 0) && (canReadRecette($idRct))) {
	$recette = getRecette($idRct);
	$information = getInformation($idRct);
	$ingredients = getIngredients($idRct);
	$utensilles = getUtensilles($idRct);
}
else {
	header("Location:index.php");
	die();
}
?>

<!DOCTYPE HTML>
<html>
<head>
	<title>Recette: <?php echo($recette['titre']); ?></title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/comment.css" />
</head>
<body class="is-preload">
	<div id="wrapper">
		<div id="main">
			<div class="inner">
				<?php include 'includes/header.php';?>

				<section>
					<header class="major">
						<h2><?php echo($recette['titre']); ?></h2>
					</header>

					<span class="image fit"><img src='<?php echo ('img/' . $recette['photo']) ?>' /></span>

					<div class="row gtr-uniform">
						<div class="col-3 col-12-small">
							<h4>Categorie:</h4>
						</div>
						<div class="col-3 col-12-small">
							<h3>
								<?php echo $information['categorie'] ?>
							</h3>
						</div>
					</div>

					<div class="row gtr-uniform">
						<div class="col-3 col-12-small">
							<h4>Duree cuisson:</h4>
						</div>
						<div class="col-3 col-12-small">
							<h3>
								<?php echo $information['dureecui'] ?>
							</h3>
						</div>
					</div>

					<div class="row gtr-uniform">
						<div class="col-3 col-12-small">
							<h4>Duree Répos:</h4>
						</div>
						<div class="col-3 col-12-small">
							<h3>
								<?php echo $information['dureerepos'] ?>
							</h3>
						</div>
					</div>

					<div class="row gtr-uniform">
						<div class="col-3 col-12-small">
							<h4>Duree Préparation:</h4>
						</div>
						<div class="col-3 col-12-small">
							<h3>
								<?php echo $information['dureeprep'] ?>
							</h3>
						</div>
					</div>

					<div class="row gtr-uniform">
						<div class="col-3 col-12-small">
							<h4>Dificulte:</h4>
						</div>
						<div class="col-3 col-12-small">
							<h3>
								<div class="star-rating">
									<?php
									$i = 0;
									$diff = $information['diff'];
									while ($i<5) {
										if ($i < $diff) {
											?>
											<a style="color: #f56a6a;">&#9733;</a>
											<?php
										} else {
											?>
											&#9733;
											<?php
										}
										$i++;
									}
									?>
								</div>
							</h3>
						</div>
					</div>

					<div class="row gtr-uniform">
						<div class="col-3 col-12-small">
							<h4>Prix:</h4>
						</div>
						<div class="col-3 col-12-small">
							<h3>
								<div class="star-rating">
									<?php
									$i = 0;
									$cout = $information['cout'];
									while ($i<3) {
										if ($i < $cout) {
											?>
											<a style="color: #f56a6a;">&#9733;</a>
											<?php
										} else {
											?>
											&#9733;
											<?php
										}
										$i++;
									}
									?>
								</div>
							</h3>
						</div>
					</div>

					<br/>

					<div class="row gtr-uniform">
						<div class="col-3 col-12-small">
							<h4>Ingredients:</h4>
						</div>
						<div class="col-6 col-12-small">
							<h3>
								<?php 
								$parsedIng = str_getcsv(
									$ingredients['nom'], # Input line
									'{',   # Delimiter
									'"',   # Enclosure
									'\\'   # Escape char
								  );
								
								  
								$i=0;
								while($i<count($parsedIng)-1){
									$parsedIng[$i];
									$Ing_test = $parsedIng[$i];
									echo $ingCant = substr($Ing_test,0,strpos($Ing_test, '-'))."\n";
									$Ing_test=substr($Ing_test,strpos($Ing_test, '-')+1);
									echo $ingUn=substr($Ing_test,0,strpos($Ing_test, '-'))."\n";
									echo $ingNom=substr($Ing_test,strpos($Ing_test, '-')+1);
									echo "<br/>";
									$i++;
								} 
								  ?>
							</h3>
						</div>
					</div>

					<br/>
					<div class="row gtr-uniform">
						<div class="col-3 col-12-small">
							<h4>Ustensiles:</h4>
						</div>
						<div class="col-6 col-12-small">
							<h3>
								<?php 
								$parsedUt = str_getcsv(
									$utensilles['nom'], # Input line
									'{',   # Delimiter
									'"',   # Enclosure
									'\\'   # Escape char
								  );
								
								  
								$i=0;
								while($i<count($parsedUt)-1){
									echo $parsedUt[$i];
									echo "<br/>";
									$i++;
								} 
								  ?>
							</h3>
						</div>
					</div>

					<?php
					$etapes = getEtapes($idRct);
					$i = 1;
					while ($etape = $etapes->fetch_assoc()) {
						?>

						<h2 id="content">Étape <?php echo $i ?></h2>
						<p><?php echo $etape['nom']; ?></p>
						
						<?php
						$i++;
					}
					?>


                <?php $idrec = $idRct;?>
                <?php $result = getComments($idrec);?>

                <section>
                    <header class="major">
                        <h2 id = "comment_title">Commentaires</h2>
                    </header>
                    <div class="col-4 col-12-medium">

                        <?php while ($fila = $result->fetch_assoc()) {?>
                            <div class = "comments-container">
                                <div class=" comment-box">

                                    <div class = "comment-head">
                                        <div class = "comment-profile"><img src="images/user.png"></div>
                                        <h3 class="comment-name">
                                            <?php
                                            $username_c = $fila["username"];
                                            $id_comment = $fila["id"];
                                            echo $username_c ?>
                                        </h3>
                                        <span> <?php $date = new DateTime($fila["day"]);
                                            echo $date->format('d-m-Y');?></span>
                                        <?php  if (isAdministrator()) : ?>
                                            <a  title="Supprimer commentaire" href='<?php echo ('./recette.php?idRecette='.$idrec .'&supprimer_commentaire_admin='.$id_comment.'#comment_title' ) ?>'><i class="icon fa-trash"></i></a>
                                            <a title="Éditer commentaire" href='<?php echo ('./recette.php?idRecette='.$idrec .'&editer_commentaire_admin='.$id_comment.'#mod' ) ?>' id="mod"><i class="icon fa-edit"></i></a>
                                        <?php endif ?>
                                        <?php  if (myComments($idrec,$id_comment) and !isAdministrator()) : ?>
                                            <a title="Supprimer commentaire" href='<?php echo ('./recette.php?idRecette='.$idrec .'&supprimer_commentaire='.$id_comment.'#comment_title' ) ?>'><i class="icon fa-trash"></i></a>
                                            <a title="Éditer commentaire" href='<?php echo ('./recette.php?idRecette='.$idrec .'&editer_commentaire='.$id_comment.'#mod' ) ?>'><i class="icon fa-edit"></i></a>
                                        <?php endif ?>

                                    </div>
                                    <div class = "comment-content">
                                        <?php echo $fila["commentaire"]; ?>
                                    </div>
                                </div>
                            </div>
                        <?php }?>

                    </diV>

                    <?php if(canAddComment($idrec) and (!isset($_GET["editer_commentaire_admin"]) and !isset($_GET["editer_commentaire"]))) : ?>

                        <form method="post" action='<?php echo ('./recette.php?idRecette='.$idrec ) ?>' id="mod0">
                            <?php include 'includes/errors.php'; ?>
                            <div class="row gtr-uniform">
                                <?php if(isset($notcomment)){?>
                                    <?php if ($notcomment == "err1") : ?>
                                        <div class="col-12">
                                            <div class="alert">
                                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                                <strong>Attention!</strong>   il est néccesaire de saisir un commentaire
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($notcomment == "err2") : ?>
                                        <div class="col-12">
                                            <div class="alert">
                                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                                <strong>Attention!</strong>  erreur inattendue -----
                                            </div>
                                        </div>
                                    <?php endif; }?>

                                <!-- Break -->
                                <div class="col-12">
                                    <textarea name="commentaire" id="demo-message" value="<?php echo $commentaire; ?>" placeholder="Ajouter un nouveau commentaire" rows="6"></textarea>
                                </div>
                                <!-- Break -->
                                <div class="col-12">
                                    <ul class="actions">
                                        <li><input type="submit" value="Ajouter" class="primary" name="comment_rec" /></li>
                                        <li><input type="reset" value="Réinitialiser" /></li>
                                    </ul>
                                </div>
                            </div>
                        </form>

                    <?php endif; ?>


                    <?php if(isUser() and (isset($_GET["editer_commentaire_admin"]) or isset($_GET["editer_commentaire"])))  :

                    if(isset($_GET["editer_commentaire_admin"])) : ?>
                    <form method="post" action='<?php echo ('./recette.php?idRecette='.$idrec.'&editer_commentaire_admin='.$_GET["editer_commentaire_admin"] ) ?>'>
                        <?php endif;
                        if(isset($_GET["editer_commentaire"])) : ?>
                        <form method="post" action='<?php echo ('./recette.php?idRecette='.$idrec.'&editer_commentaire='.$_GET["editer_commentaire"] ) ?>'>
                            <?php endif; ?>

                            <?php include 'includes/errors.php'; ?>
                            <div class="row gtr-uniform">
                                <?php if(isset($notcomment)){?>
                                    <?php if ($notcomment == "err1") : ?>
                                        <div class="col-12">
                                            <div class="alert">
                                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                                <strong>Attention!</strong>   il est néccesaire de saisir un commentaire
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($notcomment == "err2") : ?>
                                        <div class="col-12">
                                            <div class="alert">
                                                <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                                                <strong>Attention!</strong>  erreur inattendue
                                            </div>
                                        </div>
                                    <?php endif; }?>

                                <!-- Break -->
                                <div class="col-12">
                                    <textarea name="commentaire" id="demo-message" value="<?php echo $commentaire; ?>" placeholder="Éditer commentaire" rows="6"><?php echo getOneComment($idrec, $id_comment); ?></textarea>
                                </div>
                                <!-- Break -->
                                <div class="col-12">
                                    <ul class="actions">
                                        <li><input type="submit" value="Sauvegarder" class="primary" name="comment_mod" /></li>
                                        <li id="mod"><input type="reset" value="Réinitialiser" /></li>
                                    </ul>
                                </div>
                            </div>
                        </form>

                        <?php endif; ?>
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