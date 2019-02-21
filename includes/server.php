<?php
if(!isset($_SESSION)){
session_start();
}
include('setup.php');

$username = "";
$email    = "";
$errors = array(); 

if (isset($_POST['update_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $iduser = $_SESSION['userid'];

  if (empty($email)) { array_push($errors, "Email requis"); }
  if (empty($password_1)) { array_push($errors, "Mot de passe requis"); }
  if ($password_1 != $password_2) {
   array_push($errors, "Les deux mots de passe ne correspondent pas");
 }

 if (count($errors) == 0) {
   $password = md5($password_1);
   $query = "UPDATE person SET email = '$email', password = '$password' WHERE id = '$iduser'";
   mysqli_query($db, $query);
 }
}

if (isset($_POST['new_comment'])) {
  $commentaire = mysqli_real_escape_string($db, $_POST['commentaire']);
  
  if (empty($commentaire)) { array_push($errors, "Le commentaire ne peut pas être vide"); }

  if (count($errors) == 0) {
    $username = $_SESSION['userid'];
    $idrecette = $_POST['idrecette'];
    $now = date("Y-m-d h:i:s");

    $query = "INSERT INTO commentaire (iduser, idrecette, texte, date) 
    VALUES('$username', '$idrecette', '$commentaire', '$now')";

    mysqli_query($db, $query);
  }
}

if (isset($_POST['delete_recette'])) {
  $idcommentaire = $_POST['idcommentaire'];

  $query = "DELETE FROM commentaire WHERE id = '$idcommentaire'";

  mysqli_query($db, $query);
}

if (isset($_POST['reg_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  if (empty($username)) { array_push($errors, "Nom d'utilisateur requis"); }
  if (empty($email)) { array_push($errors, "Email requis"); }
  if (empty($password_1)) { array_push($errors, "Mot de passe requis"); }
  if ($password_1 != $password_2) {
   array_push($errors, "Les deux mots de passe ne correspondent pas");
 }

 $user_check_query = "SELECT * FROM person WHERE username='$username' OR email='$email' LIMIT 1";
 $result = mysqli_query($db, $user_check_query);
 $user = mysqli_fetch_assoc($result);

 if ($user) {
  if ($user['username'] === $username) {
    array_push($errors, "Ce nom d'utilisateur existe déjà");
  }

  if ($user['email'] === $email) {
    array_push($errors, "L'email existe déjà");
  }
}

if (count($errors) == 0) {
 $password = md5($password_1);

 $query = "INSERT INTO person (username, email, password, type) 
 VALUES('$username', '$email', '$password',0)";
 mysqli_query($db, $query);
 $_SESSION['username'] = $username;
 header('location: index.php');
}
}

if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
    array_push($errors, "Nom d'utilisateur est nécessaire");
  }
  if (empty($password)) {
    array_push($errors, "Mot de passe requis");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM person WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      while($row = mysqli_fetch_assoc($results)) {
        $_SESSION['userid'] = $row['id'];
      }
      $_SESSION['username'] = $username;
      header('location: index.php');
    }else {
      array_push($errors, "Faux combinaison de Nom d'utilisateur / Mot de passe");
    }
  }
}

if(isset($_GET["accepterRecette"]))
{
  $idRecette = htmlspecialchars($_GET["accepterRecette"]);
  $query = "UPDATE recette SET statut = 1 where id = '$idRecette'" ;
  mysqli_query($db, $query);
}

if(isset($_GET["eliminerRecette"]))
{
  $idRecette = htmlspecialchars($_GET["eliminerRecette"]);
  $query = "UPDATE recette SET statut = 2 where id = '$idRecette'" ;
  mysqli_query($db, $query);
}

if(isset($_GET["unlockUser"]))
{
  $idUser = htmlspecialchars($_GET["unlockUser"]);
  $query = "UPDATE person SET type = 0 where id = '$idUser'" ;
  mysqli_query($db, $query);
}

if(isset($_GET["lockUser"]))
{
  $idUser = htmlspecialchars($_GET["lockUser"]);
  $query = "UPDATE person SET type = 1 where id = '$idUser'" ;
  mysqli_query($db, $query);
}

if(isset($_GET["eliminerUser"]))
{
  $idUser = htmlspecialchars($_GET["eliminerUser"]);
  $query = "UPDATE person SET type = 2 where id = '$idUser'" ;
  mysqli_query($db, $query);
}

if(isset($_GET["setModerator"]))
{
  $idUser = htmlspecialchars($_GET["setModerator"]);
  $query = "UPDATE person SET type = 3 where id = '$idUser'" ;
  mysqli_query($db, $query);
}

if (isset($_POST['reg_recette'])) {

  $nombre = $_FILES['imagen']['name'];
  $nombrer = strtolower($nombre);
  $cd=$_FILES['imagen']['tmp_name'];
  $ruta = "img/" . $_FILES['imagen']['name'];
  $destino = "img/".$nombrer;

  $Utensilles = $_POST['utname'];
  $Ingredients = $_POST['ingname'];
  $Etapes = $_POST['etname1'];
  $titre = mysqli_real_escape_string($db, $_POST['titre']);
  $dureecui = mysqli_real_escape_string($db, $_POST['dureecuisson']);
  $dureerepos = mysqli_real_escape_string($db, $_POST['dureerepos']);
  $dureeprepa = mysqli_real_escape_string($db, $_POST['dureeprepa']);
  $categorie = mysqli_real_escape_string($db, $_POST['categorie']);
  $diff = $_POST['diffname'];
  $cout = $_POST['coutname'];
  


  if (empty($titre)) { 
    array_push($errors, "Veuillez saisir le titre");
  }
  if (empty($dureecui)) { 
    array_push($errors, "Veuillez saisir la durée cuisson");
  }
  if( !ctype_digit(substr($dureecui,0,2)) || 
    !ctype_digit(substr($dureecui,3,2)) || 
    substr($dureecui,2,1) != ':'|| 
    substr($dureecui,0,2) >'24'|| 
    substr($dureecui,3,2) >'60'){
    array_push($errors, "Veuillez saisir correctement la durée cuisson");
}

if (empty($dureerepos)) { 
  array_push($errors, "Veuillez saisir le duree repos");
}
if( !ctype_digit(substr($dureerepos,0,2)) || 
  !ctype_digit(substr($dureerepos,3,2)) || 
  substr($dureerepos,2,1) != ':'|| 
  substr($dureerepos,0,2) >'24'|| 
  substr($dureerepos,3,2) >'60'){
  array_push($errors, "Veuillez saisir correctement la durée répos");
}

if (empty($dureeprepa)) { 
  array_push($errors, "Veuillez saisir le duree preparation");
}
if( !ctype_digit(substr($dureeprepa,0,2)) || 
  !ctype_digit(substr($dureeprepa,3,2)) || 
  substr($dureeprepa,2,1) != ':'|| 
  substr($dureeprepa,0,2) >'24'|| 
  substr($dureeprepa,3,2) >'60'){
  array_push($errors, "Veuillez saisir correctement la durée preparation");
}
if ($cout == null ) { 
  array_push($errors, "Veuillez selectioner coût de la recette");
}
if ($diff == null ) { 
  array_push($errors, "Veuillez selectioner difficulté de la recette");
}
if($nombre == null || $cd == null || $ruta  == null|| $destino  == null){
  array_push($errors, "Problème avec la photo, reessayez");
}
if(substr($nombrer,strpos($nombrer, '.')+1) != 'png'){
  array_push($errors, "Sélectionner photo avec format .png");
}

if (empty($Ingredients)) { 
  array_push($errors, "Veuillez saisir des ingrédients");
}
if (empty($Utensilles)) { 
  array_push($errors, "Veuillez saisir des uténsilles");
}
if (empty($Etapes)) { 
  array_push($errors, "Veuillez saisir des étapes");
}

$parsedIng = str_getcsv(
    $Ingredients, # Input line
    '{',   # Delimiter
    '"',   # Enclosure
    '\\'   # Escape char
    );


$i=0;
while($i<count($parsedIng)-1){
  $parsedIng[$i];
  $Ing_test = $parsedIng[$i];
  if(!ctype_digit(substr($Ing_test,0,strpos($Ing_test, '-')))){
    array_push($errors,"Veuillez saisir des ingrédient selon la formule proposée");
  }else{
    $Ing_test=substr($Ing_test,strpos($Ing_test, '-')+1);
    $Ing_test=substr($Ing_test,0,strpos($Ing_test, '-'));
    if($Ing_test != 'g' && $Ing_test != 'kg' && $Ing_test != 'l' && $Ing_test != 'ml' && $Ing_test != 'pince' && $Ing_test != 'cant' && $Ing_test != 'cuillere' ){
      array_push($errors,"Veuillez saisir des ingrédient selon la formule proposée");
    }
  }
  $i++;
}

$parsedEt = str_getcsv(
    $Etapes, # Input line
    '{',   # Delimiter
    '"',   # Enclosure
    '\\'   # Escape char
    );


$i=0;
while($i<count($parsedEt)-1){
  $parsedEt[$i];
  $i++;
}


$iduser = $_SESSION['userid'];
$now = date("Y-m-d h:i:s");
if (count($errors) == 0) {

  $resultado = @move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta);

  $query = "INSERT INTO recette (titre,iduser,date,photo,statut) 
  VALUES('$titre','$iduser','$now','test',0)";
  mysqli_query($db, $query);

  $query = "SELECT * FROM recette WHERE id > 0 ORDER BY id DESC LIMIT 1";
  $results = mysqli_query($db, $query);
  if (mysqli_num_rows($results) == 1) {
    while ($row = mysqli_fetch_assoc($results))
    {
      $idrecette = $row['id'];
    }
  }
  $nomphoto = $idrecette . substr($nombre,strpos($nombre, '.'),4);
  $query = "UPDATE recette SET photo ='$nomphoto' where id='$idrecette'; ";
  $results = mysqli_query($db, $query);


  $path = "./img"; 
  $dh = opendir($path); 
  $i=1; 
  while (($file = readdir($dh)) !== false) {

    if($file != "." && $file != "..") { 
      rename($path."/".$file, $path . "/".str_replace($nombrer,$nomphoto,$file)); 
      $i++; 
    } 
  } 
  closedir($dh); 


  $query = "INSERT INTO information (idrecette,dureecui,dureerepos,dureeprep,diff,cout,categorie) 
  VALUES('$idrecette','$dureecui','$dureerepos','$dureeprepa',$diff,$cout,'$categorie')";
  mysqli_query($db, $query);
  $query = "INSERT INTO ingredients (idrecette,nom) 
  VALUES('$idrecette','$Ingredients')";
  mysqli_query($db, $query);
  $query = "INSERT INTO utensilles (idrecette,nom) 
  VALUES('$idrecette','$Utensilles')";
  mysqli_query($db, $query);
  $i=0;
  while($i<count($parsedEt)-1){
    $query = "INSERT INTO etapes (idrecette,idordre,nom) 
    VALUES('$idrecette',$i,'$parsedEt[$i]')";
    mysqli_query($db, $query);
    $i++;
  }
  header('location: index.php');
}
}

/* POST COMMENT */

if (isset($_POST['comment_rec'])) {

    $commentaire = mysqli_real_escape_string($db, $_POST['commentaire']);
    $username = $_SESSION['username'];

    if (empty($commentaire)) {
        array_push($errors, " ");
        $notcomment = "err1";
    }

    $query_id = "SELECT id FROM comments ORDER BY id DESC LIMIT 1";
    $results = mysqli_query($db, $query_id);
    if (mysqli_num_rows($results) == 1) {
        while ($row = mysqli_fetch_assoc($results)) {
            $id = $row['id'];
        }

        $id_rec = $_GET['idRecette'];

        if (count($errors) == 0) {
            $hoy = date("Y-m-d H:i:s");
            $comment_insert_query = "INSERT INTO comments(idrec, id, username, day ,commentaire) VALUES($id_rec, $id +1 ,'$username','$hoy','$commentaire')";
            mysqli_query($db, $comment_insert_query) or die('Error, insert query failed');
            header("location: ./recette.php?idRecette=$id_rec#comment_title");
        }
    }
    elseif (mysqli_num_rows($results) == 0){

        $id_rec = $_GET['idRecette'];

        if (count($errors) == 0) {
            $hoy = date("Y-m-d H:i:s");
            $comment_insert_query = "INSERT INTO comments(idrec, id, username, day ,commentaire) VALUES($id_rec, 1 ,'$username','$hoy','$commentaire')";
            mysqli_query($db, $comment_insert_query) or die('Error, insert query failed');
            header("location: ./recette.php?idRecette=$id_rec#comment_title");
        }
        else{

        array_push($errors, " ");
        $notcomment = "err2";}
    }

}



/* SET COMMENT */

if (isset($_POST['comment_mod'])) {
    if (isset($_GET["editer_commentaire_admin"])){
        $id_comment = $_GET["editer_commentaire_admin"];
        $commentaire = mysqli_real_escape_string($db, $_POST['commentaire']);
        $username = $_SESSION['username'];

        if (empty($commentaire)) {
            array_push($errors, " ");
            $notcomment = "err1";
        }

        $id_rec = $_GET['idRecette'];

        if (count($errors) == 0) {
            $hoy = date("Y-m-d H:i:s");
            $comment_set_query = "UPDATE comments SET commentaire = '$commentaire', day = '$hoy' where idrec = $id_rec and id= $id_comment";
            mysqli_query($db, $comment_set_query) or die('Error, insert query failed');
            header("location: ./recette.php?idRecette=$id_rec#comment_title");
        }

        else{
            array_push($errors, " ");
            $notcomment = "err2";
        }}

    if (isset($_GET["editer_commentaire"])){
        $id_comment = $_GET["editer_commentaire"];
        $commentaire = mysqli_real_escape_string($db, $_POST['commentaire']);
        $username = $_SESSION['username'];

        if (empty($commentaire)) {
            array_push($errors, " ");
            $notcomment = "err1";
        }

        $id_rec = $_GET['idRecette'];

        if (count($errors) == 0) {
            $hoy = date("Y-m-d H:i:s");
            $comment_set_query = "UPDATE comments SET commentaire = '$commentaire', day = '$hoy' where idrec = $id_rec and id= $id_comment and username='$username'";
            mysqli_query($db, $comment_set_query) or die('Error, insert query failed');
            header("location: ./recette.php?idRecette=$id_rec#comment_title");
        }

        else{
            array_push($errors, " ");
            $notcomment = "err2";
        }}

}



/* DELETE COMMENT */

if(isset($_GET["supprimer_commentaire"])){
    $id_comment = intval(htmlspecialchars($_GET["supprimer_commentaire"]));
    $id_rec = intval(htmlspecialchars($_GET["idRecette"]));
    $username = $_SESSION["username"];
    $comment_delete_query = "DELETE FROM comments where idrec = $id_rec and id= $id_comment and username= '$username'";
    mysqli_query($db, $comment_delete_query) or die('Error, insert query failed');


}

if(isset($_GET["supprimer_commentaire_admin"])){
    $id_comment = intval(htmlspecialchars($_GET["supprimer_commentaire_admin"]));
    $id_rec = intval(htmlspecialchars($_GET["idRecette"]));
    $comment_delete_query = "DELETE FROM comments where idrec = $id_rec and id= $id_comment";
    mysqli_query($db, $comment_delete_query) or die('Error, insert query failed');


}

?>