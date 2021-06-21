<?php
include 'core/koneksi.php';
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
	                echo ' ';
	            }
	            ?>
			   </ul>
		</div>
	</nav>
	<div class="container-fluid content bg-abu">
		<div class="container">
			<div class="row p-4">
				<div class="card p-3">
					<div class="row">
					<h1 class="card-title">Meet Our Agen</h1>
					<div class="col-md-7 d-flex">
						<div class="col-sm-6 flex-fill p-3">
							<img src="assets/img/agen/agen-1.png" class="rounded" style="height: 250px;">
						</div>
						<div class="col-sm-6 flex-fill p-3 text-center">
							<div class="bg-abu rounded" style="height: 250px;">
								<img src="assets/img/logo.png" style="width: 50%;" class="text-center">
								<?php
									$id = $_GET['id'];
									$namaagentsql = "
										SELECT * FROM tb_user
										WHERE id = '$id'";
									$namaagent = mysqli_query($conn, $namaagentsql);
									$dataagent = mysqli_fetch_array($namaagent);
									$nama2 = $dataagent['nama'];
									$telp = $dataagent['no_tlp'];
									$email = $dataagent['email']; 
								?>
								<h2><?php echo $nama2; ?> <span class="fa fa-check blue"></span></h2>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span><br>
								<a href="" class="btn btn-secondary p-2 m-3"> Get Contact</a>
							</div>
						</div>
					</div>
					<div class="col-md-5 text-center pt-5">
						<p><h1>"</h1><?php echo $dataagent['deskripsi']?><h1>"</h1></p>
					</div>
					<div class="col-lg-12 p-3">
						<div class="row">
							<h2>“ My Pleasure to Serving You “</h2>
							<h4 class="pt-3"><span class="fa fa-phone blue"></span> <?php echo $telp; ?></h4>
							<h4 class="pt-3"><span class="fa fa-google orange"></span> <?php echo $email; ?></h4>
						</div>
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
			
		<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog modal-dialog-centered">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
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


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	</body>
</html>




