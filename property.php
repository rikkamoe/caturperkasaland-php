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
			<div class="row p-4">
				<h3 class="p-2 ms-4"><b> Cari Rumah</b></h3>
				<form method="post">
					<div class="form-row d-flex">
						<div class="input-group flex-fill p-2 ms-4">
							<input type="text" class="form-control p-3" placeholder="Ketik atau pilih lokasi" aria-label="Recipient's username" aria-describedby="basic-addon2" name="search" value="<?php if(isset($_POST['search'])){ echo $_POST['search'];} ?>">
							<div class="input-group-append">
								<button class="btn btn-primary p-3" type="submit" >Cari!</button>
							</div>
						</div>	
					</div>
				</form>
			</div>
		</div>	
	</div>
	<div class="container-fluid pt-4">
		<div class="container">
			<div class="row p-3">
				<div class="p-2">
					<p style="color: #108ee9;"><?php echo $idlokasi= $_GET['id']; ?></p>
					<h1><b>Property Di Daerah Terbaru</b></h1>
				</div>
				<div class="col-lg-6 pt-2">
					<?php
					if (isset($_POST['search'])) {
						$filter = $_POST['search'];
						$perintah = "SELECT * FROM tb_property 
									WHERE daerah = '$idlokasi' AND status_property > 2 AND CONCAT(harga,status_property,judul,jenis_property,luas_bangunan) 
									LIKE '%$filter%'";
                    	$query = mysqli_query($conn, $perintah);
                    	if (mysqli_num_rows($query) > 0) {
                    		foreach ($query as $dataproperty) {
                    			?>
								<div class="card mt-2">
								  	<div class="row g-0 rounded-3">
								    	<div class="col-md-4">
								     	 	<img src="public/img/<?php echo $dataproperty['image']; ?>" style="width: 100%">
								    	</div>
								    	<div class="col-md-8">
								    		<a href="detail-property.php?id=<?php echo $dataproperty['id']; ?>" class="nav-link item-list">
									      		<div class="card-body p-0 ps-2 pt-2 p-1">
									        		<h3 class="card-title"><b>Rp. <?php echo $dataproperty['harga']; ?></b></h3>
									        		<span class="btn btn-success rounded-pill"><?php echo $dataproperty['status_property']; ?></span>
									        		<h5 class="card-text"><b><?php echo $dataproperty['judul']; ?></b></h5>
									        		<p class="card-text"><span class="fa fa-map"></span> <?php echo $dataproperty['daerah']; ?></p>
									        		<h5 class="card-text"><?php echo $dataproperty['jenis_property']; ?></h5>
									        		<h5 class="card-text">Luas Bangunan : <?php echo $dataproperty['luas_bangunan']; ?>m<sup>3</sup></h5>
									        		<span>Luas Tanah : <?php echo $dataproperty['luas_tanah']; ?>m<sup>3</sup></span>
									        		<h5 class="card-text"></h5>
									        		<h5 class="card-text">
									        			<div class=" position-absolute bottom-0 end-0 pb-3 pe-2">
										        			<span class="fa fa-bed text-info p-1"></span><?php echo $dataproperty['kamar_tidur']; ?>
										        			<span class="fa fa-bath text-info p-1"></span><?php echo $dataproperty['kamar_mandi']; ?>
									        			</div>
									        		</h5>
									        		</p>
									      		</div>
								      		</a>
								    	</div>
								  	</div>
								</div>
								<?php
                    		}
                    	}else{
                    		echo 'Data Tidak Temukan!';
                    }
                }
                else
                {
						$idlokasi = $_GET['id'];
						if (isset($_POST['filter'])) 
						{
							$harga = $_POST['harga'];
							$tipe = $_POST['tipe'];
							$status = $_POST['status'];

							
							if ($harga == '1')
							{
								$cekpropertysql = "
									SELECT * FROM tb_property 
									WHERE daerah = '$idlokasi' AND status_property = '$status' AND jenis_property = '$tipe' 
									ORDER BY harga ASC";	
							}
							else if ($harga == '2')
							{
								$cekpropertysql = "
									SELECT * FROM tb_property 
									WHERE daerah = '$idlokasi' AND status_property = '$status' AND jenis_property = '$tipe' 
									ORDER BY harga DESC";
							}
							else
							{
								echo " <script>alert('Failed, Data Anda tidak lengkap'); </script> ";
								$cekpropertysql = "
									SELECT * FROM tb_property 
									WHERE daerah = '$idlokasi' AND status_property = '3' OR status_property = '4' 
									ORDER BY id DESC";
							}
						}
						else
						{
							$cekpropertysql = "
								SELECT * FROM tb_property 
								WHERE daerah = '$idlokasi' AND status_property = '3'
								ORDER BY id DESC";
						}
						$property = mysqli_query($conn, $cekpropertysql);
						while ($dataproperty = mysqli_fetch_array($property)) 
						{
							$status = $dataproperty['status_property'];
				        	if ($status == '3') 
				        	{
				        		$status = 'Dijual';
				        	}
				        	else if ($status == '4') 
				        	{
				        		$status = 'Disewakan';
				        	}
					?>
					<div class="card mt-2">
					  	<div class="row g-0 rounded-3">
					    	<div class="col-md-4">
					     	 	<img src="public/img/<?php echo $dataproperty['image']; ?>" style="width: 100%">
					    	</div>
					    	<div class="col-md-8">
					    		<a href="detail-property.php?id=<?php echo $dataproperty['id']; ?>" class="nav-link item-list">
						      		<div class="card-body p-0 ps-2 pt-2 p-1">
						        		<h3 class="card-title"><b>Rp. <?php echo $dataproperty['harga']; ?></b></h3>
						        		<span class="btn btn-success rounded-pill"><?php echo $status; ?></span>
						        		<h5 class="card-text"><b><?php echo $dataproperty['judul']; ?></b></h5>
						        		<p class="card-text"><span class="fa fa-map"></span> <?php echo $dataproperty['daerah']; ?></p>
						        		<h5 class="card-text"><?php echo $dataproperty['jenis_property']; ?></h5>
						        		<h5 class="card-text">Luas Bangunan : <?php echo $dataproperty['luas_bangunan']; ?>m<sup>3</sup></h5>
						        		<span>Luas Tanah : <?php echo $dataproperty['luas_tanah']; ?>m<sup>3</sup></span>
						        		<h5 class="card-text"></h5>
						        		<h5 class="card-text">
						        			<div class=" position-absolute bottom-0 end-0 pb-3 pe-2">
							        			<span class="fa fa-bed text-info p-1"></span><?php echo $dataproperty['kamar_tidur']; ?>
							        			<span class="fa fa-bath text-info p-1"></span><?php echo $dataproperty['kamar_mandi']; ?>
						        			</div>
						        		</h5>
						        		</p>
						      		</div>
					      		</a>
					    	</div>
					  	</div>
					</div>
					<?php
				}

            }
		?>
				</div>
				<div class="col-lg-6 pt-2">
					<form method="post">
						<div class="form-label-group p-2">
							<label for="inputEmail">Status</label>
			               	<select class="form-select" aria-label="Default select example" name="status">
			               		<option selected>-- Select --</option>
			               		<option value="3">Dijual</option>
			                  	<option value="4">Disewakan</option>
			                </select>
							<label for="inputEmail">Tipe</label>
			               	<select class="form-select" aria-label="Default select example" name="tipe">
			               		<option selected>-- Select --</option>
			                  	<option value="Rumah">Rumah</option>
			                  	<option value="Villa">Villa</option>
			                  	<option value="Apartemen">Apartemen</option>
			                </select>
			         		<label for="inputEmail">Harga</label>
			               	<select class="form-select" aria-label="Default select example" name="harga">
			               		<option selected>-- Select --</option>
			                  	<option value="1">Termurah</option>
			                  	<option value="2">Termahal</option>
			                </select>
			          	</div>
			          	<div class="text-center">
			                <button class="btn btn-lg btn-success btn-block text-uppercase text-center" type="submit" name="filter">Filter</button>
			          	</div>
					</form>
				</div>
			</div>
				<div class="col-lg-6 pt-2">

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
				<div class="col-sm-6">
					<div class="pt-4 pb-4 p-2">
						<h5><b>Found Us</b></h5>
						<a href="#" class="nav-link item"><span class="fa fa-facebook-square" style="font-size: 30px;"></span> @CaturPerkasaLand_</a>
						<a href="#" class="nav-link item"><span class="fa fa-twitter-square" style="font-size: 30px;"></span> @CaturPerkasaLand_</a>
						<a href="#" class="nav-link item"><span class="fa fa-instagram" style="font-size: 30px;"></span> @CaturPerkasaLand_</a>
					</div>
					<div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=auto&amp;height=400&amp;hl=en&amp;q=stmik primakara&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
					</div>
				</div>
				<span class="d-flex justify-content-center mx-auto">&copy 2021 Catur Perkasa Land, All Rights Reserved</span>
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


	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	</body>
</html>




