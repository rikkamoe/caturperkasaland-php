<?php
session_start();
include 'core/koneksi.php';
if (isset($_POST['register'])) 
{
   $nama = $_POST['nama'];
   $username = $_POST['username'];
   $email = $_POST['email'];
   $telephone = $_POST['telephone'];
   $as = $_POST['as'];
   $password = md5($_POST['password']);
   $password2 = md5($_POST['password2']);
   

  if (empty($nama) || empty($username) || empty($email) || empty($telephone) || empty($as) || empty($password) || empty($password2))
  {
    echo " <script>alert('Failed, Data Anda tidak lengkap')</script> ";
  }
  else {
    if ($password == $password2) {
      $usercek = "
        SELECT * FROM tb_user 
        WHERE username = '$username' AND password = '$password'";
      $cek = mysqli_query($conn, $usercek);

      if (mysqli_num_rows($cek)==0) 
      {
        $sql = "
          INSERT INTO tb_user 
          (nama, no_tlp, email, username, password, level) 
          VALUES 
          ('$nama', '$telephone', '$email', '$username', '$password', '$as')";
        $register = mysqli_query($conn, $sql);
        if ($register) 
        {
          $loginsql = "
            SELECT * FROM tb_user
            WHERE username = '$username' AND password = '$password'";
          $login = mysqli_query($conn, $loginsql);
          $datalogin = mysqli_fetch_array($login);

          $_SESSION["username"]= $datalogin['username'];
          $_SESSION["login"] = $datalogin['id'];
          echo " <script>alert('Success, Anda Sudah Membuat Akun !');window.location='index.php'; </script> ";
        }
        else
        {
          echo " <script>alert('Failed, Membuat Akun'); </script> ";
        }   
      } 
      else
      {
        echo " <script>alert('Failed, Membuat Akun'); </script> ";
      }
    }
    else 
    {
      echo " <script>alert('Failed, Password Anda Berbeda !')</script> ";
    }    
  } 
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ASTRA MODERNLAND</title>
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Khula" />
    <link href='https://fonts.googleapis.com/css?family=Kodchasan' rel='stylesheet'>
    <link rel="stylesheet" href="css/cssreset-min.css"/>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
    <script type="text/javascript" src="assets/js/menu.js"></script>
    <script src="https://use.fontawesome.com/f924bc844c.js"></script>
  </head>
<body class="bg-abu">
  <div class="container">
    <div class="row" style="height: 100vh;">
      <div class="col-lg-5 mx-auto">
        <div class="card card-signin flex-row mt-5">
          <div class="card-img-left d-none d-md-flex">
             <!-- Background image for card set in CSS! -->
          </div>
          <div class="card-body">
            <h2 class="card-title text-center">Register</h2>
            <form class="form-signin" method="post">
              
              <div class="form-label-group p-2">
                <label for="inputUserame">Name</label>
                <input type="text" id="inputUserame" class="form-control" placeholder="Name" name="nama" required autofocus>
              </div>

              <div class="form-label-group p-2">
                <label for="inputUserame">Username</label>
                <input type="text" id="inputUserame" class="form-control" placeholder="Username" name="username" required autofocus>
              </div>

              <div class="form-label-group p-2">
                <label for="inputEmail">Email address</label>
                <input type="email" id="inputEmail" class="form-control" placeholder="Email address" name="email" required>
              </div>

              <div class="form-label-group p-2">
                <label for="inputEmail">No telephone</label>
                <input type="text" id="inputEmail" class="form-control" placeholder="No telephone" name="telephone" required>
              </div>

              <div class="form-label-group p-2">
                <label for="inputEmail">Register as</label>
                <select class="form-select" aria-label="Default select example" name="as">
                  <option selected>-- Select --</option>
                  <option value="1">Owner</option>\
                  <option value="3">Customer</option>
                </select>
              </div>

              <div class="form-label-group p-2">
                <label for="inputPassword">Password</label>
                <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
              </div>
              
              <div class="form-label-group p-2">
                <label for="inputConfirmPassword">Confirm password</label>
                <input type="password" id="inputConfirmPassword" class="form-control" placeholder="Password" name="password2" required>
              </div>

              <div class="text-center">
                <button class="btn btn-lg btn-success btn-block text-uppercase text-center" type="submit" name="register">Register</button>
                <a class="d-block text-center mt-2 small nav-link item" href="#">Sign In</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>

</html>