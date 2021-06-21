<?php
session_start();
include 'core/koneksi.php';
if (isset($_POST['login'])) 
{
	$username = $_POST['username'];
  	$password = md5($_POST['password']);

  	if (empty($username) || empty($password))
  	{
   		echo " <script>alert('Failed, Data Anda tidak lengkap'); </script> ";
 	}
  	else 
  	{
    	$ceklogin="SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'";
    	$login=mysqli_query($conn ,$ceklogin);

    	if (mysqli_num_rows($login)==0) 
    	{
      		echo " <script>alert('Failed, Data Akun Anda Tidak Ada'); </script> ";      
    	} 
    	else 
    	{
			$datalogin = mysqli_fetch_array($login);
			$_SESSION["username"]= $datalogin['username'];
			$_SESSION["login"] = $datalogin['id'];
			header("location: index.php");    
    	}
  	}		
}
if (isset($_POST['submit'])) {
	$name =  $_POST['nama'];
	$massage =  $_POST['massage'];
	$massage2 =  $_POST['massage2'];
	$nomer =  $_POST['nomer'];

	header("location:https://api.whatsapp.com/send?phone=$nomer&text=Nama:%20$name%20%0DMassage:%20$massage%20%0DPerihal:%20$massage2");
}else{
	echo "
		<script>
			windows.location=history.go(-1);
		</script>
	";
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>CATUR PERKASALAND</title>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Khula" />
		<link href='https://fonts.googleapis.com/css?family=Kodchasan' rel='stylesheet'>
		<link rel="stylesheet" href="css/cssreset-min.css"/>
		<link rel="stylesheet" href="css/style.css">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

		<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="assets/js/menu.js"></script>
		<script src="https://use.fontawesome.com/f924bc844c.js"></script>
	</head>
	<body>
		<!-- Navbar -->
	<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white d-flex">
		<a class="navbar-brand justify-content-start me-auto ms-4 col-3" href="index.php">
			<img src="assets/img/logo.png" style="width: 20%;">
		</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="navbar-toggler-icon"></span>
	     	</button>
	     	<div class="col-6 text-center collapse navbar-collapse justify-content-center"id="navbarNav">
	     		<h1>CATUR PERKASA LAND</h1>
	     	</div>
		<div class="collapse navbar-collapse justify-content-center col-3" id="navbarNav">
			<ul class="navbar-nav p-2">
				<?php if (isset($_SESSION["login"])) 
				{
				 	$id = $_SESSION['login'];
					$cekusersql = "
						SELECT * FROM tb_user
						WHERE id = '$id'";
					$cekuser = mysqli_query($conn, $cekusersql);
					$datauser = mysqli_fetch_array($cekuser);
					
					$level = $datauser['level'];
					$namauser = $datauser['nama'];

					if ($level == '1') 
					{
						echo '
				            <li class="nav-item m-4">
						    	<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#ModalIklan">
								  	Pasang Iklan
								</button>
						    </li>
						    <li class="nav-item m-4">
								<a class="btn btn-secondary" id="dropdownMenuButton1" aria-expanded="false" href="logout.php">
									Logout
								</a>
						    </li>
					    ';		
					} 
					else if ($level == '2')
					{
						echo '
				            <li class="nav-item m-4">
						    	<button type="button" class="btn">
								  	Agent '.$namauser.' 
								</button>
						    </li>
						    <li class="nav-item m-4">
								<a class="btn btn-secondary" id="dropdownMenuButton1" aria-expanded="false" href="logout.php">
									Logout
								</a>
						    </li>
					    ';	
					}
					else if ($level == '0')
				  	{
				  		echo '
				            <li class="nav-item m-4">
						    	<button type="button" class="btn">
								  	Admin '.$namauser.' 
								</button>
						    </li>
						    <li class="nav-item m-4">
								<a class="btn btn-secondary" id="dropdownMenuButton1" aria-expanded="false" href="logout.php">
									Logout
								</a>
						    </li>
					    ';	
				  	}
				    
				  }
				else
				{
				    echo '
				    	
				    ';
				}
				?>
			</ul>
		</div>
	</nav>
	<div class="container-fluid content bg-abu">
		<div class="container">
			<div class="row">
				<div class="card p-3">
					<div class="row">
						<h1 class="card-title text-center pt-2">Detail Property</h1>
						<?php
						$id = $_GET['id'];
						$detailpropertysql = "
							SELECT * FROM tb_property
							WHERE id = '$id'";
						$detail = mysqli_query($conn, $detailpropertysql);
						$datadetail = mysqli_fetch_array($detail);
						?>
						<img src="public/img/<?php echo $datadetail['image']?>">
						<div class="col-lg-8 p-4">
							<h3 class="card-title"> <?php echo $datadetail['judul']; ?></h3>
							<h3 class="card-text"> <b>Rp. <?php echo $datadetail['harga']; ?></b></h3>
							<p class="card-text" class="col-6">
								<span class="fa fa-map"></span> <?php echo $datadetail['daerah']; ?> 
							</p>
						    <h5 class="card-text">
						     	<span>Luas Tanah : <?php echo $datadetail['luas_tanah']; ?><sup>3</sup> | Luas Bangunan : <?php echo $datadetail['luas_bangunan']; ?><sup>3</sup></span>
							    <span class="fa fa-bed text-info p-1"></span><?php echo $datadetail['kamar_tidur']; ?>
							    <span class="fa fa-bath text-info p-1"></span><?php echo $datadetail['kamar_mandi']; ?>
							    <span class="fa fa-arrows-alt text-info p-1"></span>500
						    </h5>
						    <hr class="col-10 mx-auto">
						    <div class="mapouter mx-auto col-12">
						    	<div class="gmap_canvas">
						    		<iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=400&amp;height=400&amp;hl=en&amp;q=<?php echo $datadetail['alamat'];?>&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
						    		</iframe>
						    	</div>
							</div>
						</div>
						<?php

								$id = $_GET['id'];
								$agentsql = "
									SELECT * FROM tb_property
									INNER JOIN tb_user
									ON tb_property.id_agent = tb_user.id
									WHERE tb_property.id = '$id'";
								$agent = mysqli_query($conn, $agentsql);
								$dataagent = mysqli_fetch_array($agent);
								echo '
									<div class="col-lg-4 p-4">
										<div class="card">
											<h4 class="card-title text-center pt-2">Tanya Tentang Property Ini</h4>
											<img src="assets/img/agen/agen.png" class="mx-auto pt-4 pb-4" style="width: 15%;">
											<h5 class="card-title text-center pt-2">Agent '.$dataagent['nama'].'</h5>
											<a href="#" class="btn btn-secondary col-8 mx-auto p-2 m-2"><span class="fa fa-phone blue"></span>+62 '.$dataagent['no_tlp'].'</a>
											<a href="http://wa.me/62'.$dataagent['no_tlp'].'" class="btn btn-secondary col-8 mx-auto p-2 m-2" target="_blank"><span class="fa fa-whatsapp green"></span> WhatsApp Link</a>
											<a href="#" class="btn btn-secondary col-8 mx-auto p-2 m-2"><span class="fa fa-google orange"></span> '.$dataagent['email'].'</a>

									    	<button type="button" class="btn btn-success col-10 mx-auto p-3 m-2" data-bs-toggle="modal" data-bs-target="#modalsend">
											  	<span class="fa fa-envelope"></span> Send Enquiry 
											</button>
										</div>
									</div>
								';
						?>
						
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid bg-abu">
			<div class="row col-lg-12 mx-auto">
				<div class="col-sm-6 d-flex">
					<div class="pt-4 pb-4 p-2 flex-fill">
						<h5><b>TENTANG</b></h5>
						<a href="#" class="nav-link item">Syarat dan Ketentuan</a>
						<a href="#" class="nav-link item">Kebijakan Privasi</a>
						<a href="#" class="nav-link item">Hak Cipta</a>
						<a href="#" class="nav-link item">Tentang Kami</a>
						<a href="#" class="nav-link item">Press </a>
						<a href="#" class="nav-link item">Rumah Subsidi</a>
						<a href="#" class="nav-link item">Peta Lokasi Proyek</a>
						<?php 
						if (isset($_SESSION['login'])) 
						{
							echo '';
						}
						else
						{
							echo '
								<div class="mt-3">
							    	<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#ModalLogin">
									  	Login
									</button>
									<a class="btn btn-secondary" id="dropdownMenuButton1" aria-expanded="false" href="register.php">
										Register
									</a>
								</div>
							';
						}
						?>
					</div>
					<div class="pt-4 pb-4 p-2 flex-fill">
						<h5><b>CUSTOMER SERVICE</b></h5>
						<a href="#" class="nav-link item">Cara Kerja</a>
						<a href="#" class="nav-link item">Keuntungan Agen</a>
						<a href="#" class="nav-link item">Karir</a>
						<a href="#" class="nav-link item">FAQs</a>
						<a href="#" class="nav-link item">Hubungi Kami</a>
						<a href="#" class="nav-link item">Pedoman Property</a>
						<a href="#" class="nav-link item">Academy</a>
					</div>
					<div class="pt-4 pb-4 p-2 flex-fill">
						<h5><b>SIMULASI KPR</b></h5>
						<a href="#" class="nav-link item">Simulasi KPR Maybank</a>
						<a href="#" class="nav-link item">Simulasi KPR BCA</a>
						<a href="#" class="nav-link item">Siemulasi KPR BTN</a>
						<a href="#" class="nav-link item">Simulasi KPR Mandiri</a>
						<a href="#" class="nav-link item">Simulasi KPR BNI</a>
						<a href="#" class="nav-link item">Simulasi KPR BRI</a>
						<a href="#" class="nav-link item">Simulasi KPR Danamon</a>
						<a href="#" class="nav-link item">Simulasi KPR Permata</a>
						<a href="#" class="nav-link item">Simulasi KPR Mega</a>
					</div>
				</div>
				<div class="col-sm-6 d-flex">
					<div class="pt-4 pb-4 p-2 flex-fill">
						<h5><b>Found Us</b></h5>
						<a href="#" class="nav-link item"><span class="fa fa-facebook-square" style="font-size: 30px;"></span> @CaturPerkasaLand_</a>
						<a href="#" class="nav-link item"><span class="fa fa-twitter-square" style="font-size: 30px;"></span> @CaturPerkasaLand_</a>
						<a href="#" class="nav-link item"><span class="fa fa-instagram" style="font-size: 30px;"></span> @CaturPerkasaLand_</a>
					</div>
					<div class="mapouter flex-fill">
						<div class="gmap_canvas">
							<iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=500&amp;height=400&amp;hl=en&amp;q=stmik primakara&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
							</iframe>
						</div>
					</div>
				</div>

				<span class="d-flex justify-content-center">&copy 2021 Catur Perkasa Land, All Rights Reserved</span>
			</div>
		</div>

		<!-- Modal Login-->
		<div class="modal fade" id="ModalLogin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body text-center">
					<img src="assets/img/logo.png" style="width: 40%;" class="">
		        <form method="post">
		        	<h1>LOGIN</h1>
					<div class="form-group p-2">
					    <input type="text" class="form-control p-2" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username*" name="username">
					</div>
					<div class="form-group p-2">
					    <input type="password" class="form-control p-2" id="exampleInputPassword1" placeholder="Password" name="password">
					</div>
					<button type="submit" class="btn btn-primary btn-lg  m-3 rounded-pill" name="login">Login</button>
				</form>
		        <hr>
		        <a href="#" class="btn btn-primary btn-lg rounded-pill m-1"><span class="fa fa-facebook"></span> Login With Facebook</a>
		        <a href="#" class="btn btn-danger btn-lg rounded-pill m-1"><span class="fa fa-google"></span> Login With Google</a>
		      </div>
		    </div>
		  </div>
		</div>
			
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Selamat Datang !!</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		        <form>
					<div class="form-group p-2">
					    <label for="exampleInputEmail1">Email Anda</label>
					    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
					</div>
					<div class="form-group p-2">
					    <label for="exampleInputPassword1">Password</label>
					    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
					</div>
					<div class="form-check">
					    <input type="checkbox" class="form-check-input" id="exampleCheck1">
					    <label class="form-check-label" for="exampleCheck1">Check me out</label>
				  	</div>
				</form>
		      </div>
		      <div class="modal-footer p-2">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
		        <button type="submit" class="btn btn-primary">Login</button>
		      </div>
		    </div>
		  </div>
		</div>


		<!-- Modal -->
		<div class="modal fade" id="modalsend" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Kirim Pesan</h5>
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body">
		      	<?php
					$id = $_GET['id'];
					$namaagentsql = "
						SELECT * FROM tb_property
						INNER JOIN tb_user
						ON tb_property.id_agent = tb_user.id
						WHERE tb_property.id = '$id'";
					$namaagent = mysqli_query($conn, $namaagentsql);
					$dataagent = mysqli_fetch_array($namaagent);
					$telp = $dataagent['no_tlp'];
					$judul = $dataagent['judul'];
					$harga = $dataagent['harga'];
				?>
		        <form method="post" target="_blank">
					<div class="form-group p-2">
					    <label for="exampleInputEmail1">Nama</label>
					    <input type="text" class="form-control" name="nama" placeholder="Enter Nama" required>
					</div>
					<div class="form-group p-2">
					    <label for="exampleInputEmail1">Massage</label>
					    <input type="text" class="form-control" name="massage" value="hai, saya tertarik dengan iklan yg anda tawarkan (<?php echo $judul; ?>) dengan harga (<?php echo $harga; ?>)">
					</div>
					<div class="form-group p-2">
					    <label for="exampleInputEmail1">Perihal lain</label>
					    <input type="text" class="form-control" name="massage2">
					</div>
					<input type="text" name="nomer" value="62<?php echo $telp; ?>" hidden>
		      <div class="modal-footer p-2">
		        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
		        <button type="submit" class="btn btn-primary" name="submit">Kirim</button>
		      </div>
				</form>
		      </div>
		    </div>
		  </div>
		</div>


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	</body>
</html>




