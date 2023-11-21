<?php
session_start();
include "conexion.php";
if (isset($_POST['submit'])) {
  if (!empty($_POST['email']) and !empty($_POST['password'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);

    $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE mail = ? AND password = ?');
    $recupUser->execute(array($email, $password));

    if ($recupUser->rowCount() > 0) {
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      $_SESSION['id'] = $recupUser->fetch()['id'];
      header('Location: home.php');
    } else {
      echo "votre mot de passe ou email incorrect";
    }
  } else {
    echo "Veuillez remplir tout les champs";
  }
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="title_login">
    <p class="title">Login</p>
  </div>
  <div class="container_form_login">
    <div class="box_welcome">
      <p class="welcome">Welcome</p>
      <p class="text_welcome">Let’s log you in quickly</p>
    </div>
    <form method="POST">
      <input type="text" name="email" placeholder="Entrer votre email" />
      <input type="password" name="password" placeholder="Entrer votre password" />
      <div class="container_btn">
        <button class="btn_first" type="submit" name="submit">SUBMIT</button>
        <div class="already_account">
          <p class="text_white">don’t have an account?</p>
          <a href="sign-up.php">
            <p class="text_green">sign-up</p>
          </a>
        </div>
      </div>
    </form>

  </div>
</body>

</html>