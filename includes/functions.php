<?php

function getRecettesMod() {
  include('setup.php');

  $user_check_query = "SELECT * FROM recette where statut = 0";
  $result = mysqli_query($db, $user_check_query);

  return $result;
}

function getCommentaires($idRecette) {
  include('setup.php');

  $user_check_query = "SELECT * FROM commentaire where idrecette = '$idRecette'";
  $result = mysqli_query($db, $user_check_query);

  return $result;
}
function getIngredients($idRecette) {
  include('setup.php');

  $user_check_query = "SELECT * FROM ingredients where idrecette = '$idRecette'";
  $result = mysqli_query($db, $user_check_query);

  return $result->fetch_assoc();
}
function getEtapes($idRecette) {
  include('setup.php');

  $user_check_query = "SELECT * FROM etapes where idrecette = '$idRecette' ORDER BY idordre ASC";
  $result = mysqli_query($db, $user_check_query);

  return $result;
}
function getUtensilles($idRecette) {
  include('setup.php');

  $user_check_query = "SELECT * FROM utensilles where idrecette = '$idRecette'";
  $result = mysqli_query($db, $user_check_query);

  return $result->fetch_assoc();
}

function getNomUser($idUser) {
  include('setup.php');

  $user_check_query = "SELECT username FROM person where id = '$idUser'";
  $result = mysqli_query($db, $user_check_query);

  return $result->fetch_assoc();
}

function getUtilisateurs() {
  include('setup.php');

  $user_check_query = "SELECT * FROM person";
  $result = mysqli_query($db, $user_check_query);

  return $result;
}

function isAdministrator() {
  include('setup.php');
  if(isset($_SESSION['userid'])){
  $idUser = $_SESSION['userid'];
  $user_check_query = "SELECT * FROM person where id = '$idUser'";
  $result = mysqli_query($db, $user_check_query);

  $user = $result->fetch_assoc();
  if ($user['type'] == 3) { // 3 -> Administrator
    return true;
  }
  }
  return false;
}

function isOwer($idRecette) {
  include('setup.php');
  if(isset($_SESSION['userid'])){
  $idUser = $_SESSION['userid'];
  $user_check_query = "SELECT * FROM recette where id = '$idRecette'";
  $result = mysqli_query($db, $user_check_query);

  $recette = $result->fetch_assoc();
  if ($recette['iduser'] == $idUser) {
    return true;
  }
  }
  return false;
}

function isPublic($idRecette) {
  include('setup.php');

  $user_check_query = "SELECT * FROM recette where id = '$idRecette'";
  $result = mysqli_query($db, $user_check_query);

  $recette = $result->fetch_assoc();
  if ($recette['statut'] == 1) {
    return true;
  }

  return false;
}

function canReadRecette($idRecette) {
  include('setup.php');

  if(isAdministrator() || isOwer($idRecette) || isPublic($idRecette)) {
    return true;
  }

  return false;
}

function getRecette($idRecette) {
  include('setup.php');

  $user_check_query = "SELECT * FROM recette where id = '$idRecette'";
  $result = mysqli_query($db, $user_check_query);

  return $result->fetch_assoc();
}

function getInformation($idRecette) {
  include('setup.php');

  $user_check_query = "SELECT * FROM information where idrecette = '$idRecette'";
  $result = mysqli_query($db, $user_check_query);

  return $result->fetch_assoc();
}

function getUser($idUser) {
  include('setup.php');

  $user_check_query = "SELECT * FROM person where id = '$idUser'";
  $result = mysqli_query($db, $user_check_query);

  return $result->fetch_assoc();
}

function getLastsRecettes() {
  include('setup.php');

  $user_check_query = "SELECT * FROM recette WHERE statut = 1 ORDER BY id DESC";
  $result = mysqli_query($db, $user_check_query);

  return $result;
}

/*---- OTROS COMENTARIOS ----*/


function getComments($idrec) {
    include('setup.php');

    $comment_query = "SELECT * FROM comments where idrec = '$idrec'";
    $result = mysqli_query($db, $comment_query);

    return $result;

}

function myComments($idrec,$id) {
    include('setup.php');

    $mycomment_query = "SELECT * FROM comments where idrec = '$idrec' and id = '$id'";
    $result = mysqli_query($db, $mycomment_query);

    $user = $result->fetch_assoc();
    if (isset($_SESSION["username"])){$username = $_SESSION["username"];
        if ($user['username'] == $username) {
            return true;
        }
    }
    return false;

}

function isUser() {
    include('setup.php');

    if (isset($_SESSION["userid"])) {
        $idUser = $_SESSION['userid'];
        $user_check_query = "SELECT * FROM person where id = '$idUser'";
        $result = mysqli_query($db, $user_check_query);

        $user = $result->fetch_assoc();
        if ($user['type'] == 0 or $user['type'] == 3) { // 3 -> User available or Administrator
            return true;
        }
    }
    elseif(isset($_SESSION["username"])){
      $username = $_SESSION["username"];
      $user_id_check_query = "SELECT * FROM person where username = '$username'";
      $result = mysqli_query($db, $user_id_check_query);
      $result_text = $result->fetch_assoc();
      $idUser = $result_text['id'];
      $_SESSION['userid'] = $idUser;
      $user_check_query = "SELECT * FROM person where id = '$idUser'";
      $result = mysqli_query($db, $user_check_query);

      $user = $result->fetch_assoc();
      if ($user['type'] == 0 or $user['type'] == 3) { // 3 -> User available or Administrator
          return true;
      }
    }
    return false;
}


function canAddComment($idRecette) {
    include('setup.php');

    if(isset($_SESSION['username']) and !isOwer($idRecette)) {
        return true;
        echo "hola";
    }

    return false;
}

function getOneComment($idrec,$idcom) {
  include('setup.php');

  if (isset($_SESSION["username"])){$username = $_SESSION["username"];

  $comment_query = "SELECT commentaire FROM comments where idrec = '$idrec' and id = '$idcom'";
  $result = mysqli_query($db, $comment_query);
  $result_text = $result->fetch_assoc();
  return $result_text['commentaire'];
  }
}


?>