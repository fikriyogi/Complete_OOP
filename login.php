<?php 
session_start();
include('class/db.class.php');
$database = new database();

if(isset($_SESSION['is_login']))
{
    header('location:home.php');
}

if(isset($_COOKIE['email']))
{
  $database->relogin($_COOKIE['email']);
  header('location:home.php');
}

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $_SESSION['email'] = $email;

    $password = $_POST['password'];
    if(isset($_POST['remember']))
    {
      $remember = TRUE;
    }
    else
    {
      $remember = FALSE;
    }
    $database->login($email,$password,$remember);

    // if($database->login($email,$password,$remember))
    // {
    //   header('location:home.php');
    // }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title>Login Form</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/starter-template/">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS ?>style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo CSS ?>bootstrap.min.css">

    <!-- Bootstrap core CSS -->

    <!-- Custom styles for this template -->
  </head>
  <body class="text-center">

   <?php echo gen_uuid() ?>
   <div class="login">
    <form class="form-signin" method="post" action="">
  <img class="mb-4" src="<?php echo IMG ?>login-logo.jpg" alt="" width="250" >
  <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
  <div class="mt-2">
  <label for="email" class="sr-only">Username</label>
  <input type="text" id="email" class="form-control" placeholder="email" name="email" required autofocus>
  </div>

  <div class="mt-2">
    <label for="password" class="sr-only mt-2">Password</label>
    <input type="password" id="password" class="form-control" placeholder="Password" name="password" required>
  </div>
  <div class="mt-2">
    <select class="form-control">
      <option>Administrator</option>
      <option>Guru</option>
      <option>Orang Tua</option>
      <option>Siswa</option>
    </select>
  </div>
  <div class="checkbox mb-3">
    <label>
      <input type="checkbox" value="remember-me" name="remember"> Remember me
    </label>
  </div>
  <button class="btn btn-lg btn-primary btn-block" type="submit" name="login">Sign in</button>
  <a href="forgot-password.php" class="btn btn-lg btn-success btn-block">Forgot Password</a>
  <a href="register.php" class="btn btn-lg btn-success btn-block">Register</a>
  <p class="mt-5 mb-3 text-muted">Warung Belajar &copy; 2019</p>
</form>
</div>
</body>
</html>