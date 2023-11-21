<?php
session_start();
include "conexion.php";
if (isset($_POST['submit'])) {
  if (!empty($_POST['name']) and !empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['confirme'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = sha1($_POST['password']);

    $insertUser = $bdd->prepare('INSERT INTO utilisateur(name, mail, password)VALUES(?, ?, ?)');
    $insertUser->execute(array($name, $email, $password));

    $recupUser = $bdd->prepare('SELECT * FROM utilisateur WHERE name = ? AND mail = ? AND password = ?');
    $recupUser->execute(array($name, $email, $password));
    if ($recupUser->rowCount() > 0) {
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;
      $_SESSION['id'] = $recupUser->fetch()['id'];
    }
    header('Location: login.php');
  } else {
    echo "veuillez remplir tout le champs";
  }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sign-up</title>
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <div class="title_login">
    <p class="title">Sign-up</p>
  </div>
  <div class="container_form_login">
    <div class="box_welcome">
      <p class="welcome">Welcome</p>
      <p class="text_welcome">Let’s log you in quickly</p>
    </div>
    <form method="POST">
      <input type="text" name="name" placeholder="Entrer votre nom" />
      <input type="text" name="email" placeholder="Entrer votre email" />
      <input type="password" name="password" placeholder="Entrer votre password" />
      <input type="password" name="confirme" placeholder="Confirmer votre password" />
      <div class="container_btn">
        <button class="btn_first" type="submit" name="submit">SUBMIT</button>
        <div class="already_account">
          <p class="text_white">already have an account?</p>
          <a href="login.php">
            <p class="text_green">log-in</p>
          </a>
        </div>
    </form>
  </div>
  </div>
</body>

</html>