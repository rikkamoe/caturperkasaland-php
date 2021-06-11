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
else if (isset($_POST['input']))
{
	$tipe = $_POST['tipe'];
	$status = $_POST['status'];
	$luas_bangunan = $_POST['luas_bangunan'];
	$luas_tanah = $_POST['luas_tanah'];
	$kamar_tidur = $_POST['kamar_tidur'];
	$kamar_mandi = $_POST['kamar_mandi'];
	$daerah = $_POST['daerah'];
	$nama = $_SESSION['login'];
	$lantai = $_POST['lantai'];
	$fasilitas = $_POST['fasilitas'];
	$alamat = $_POST['alamat'];
	$judul = $_POST['judul'];
	$harga = $_POST['harga'];
	$deskripsi = $_POST['deskripsi'];
	$agent = $_POST['agent'];

	$ekstensi_diperbolehkan  = array('png','jpg');
    $images = $_FILES['images']['name'];
    $x = explode('.', $images);
    $randomname = round(microtime(true)) . '.' . end($x); 
    $ekstensi = strtolower(end($x));
    $ukuran = $_FILES['images']['size'];
    $file_tmp = $_FILES['images']['tmp_name'];

    $ekstensi_diperbolehkan2  = array('png','jpg');
    $images2 = $_FILES['images2']['name'];
    $x2 = explode('.', $images2);
    $randomname2 = round(microtime(true)) . '.' . end($x2); 
    $ekstensi2 = strtolower(end($x2));
    $ukuran2 = $_FILES['images2']['size'];
    $file_tmp2 = $_FILES['images2']['tmp_name'];

    if (empty($tipe) || empty($status) || empty($luas_bangunan) || empty($luas_tanah) || empty($kamar_tidur) || empty($kamar_mandi) || empty($daerah) || empty($nama) || empty($lantai) || empty($fasilitas) || empty($alamat) || empty($judul) || empty($harga) || empty($deskripsi) || empty($randomname) || empty($randomname2)) {
    	echo " <script>alert('Failed, Data Anda tidak lengkap'); </script> ";
    }
    else 
    {
    	if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) 
    	{
			if ($ukuran < 2044070) 
			{
				move_uploaded_file($file_tmp, 'public/img/'.$randomname);
				if (in_array($ekstensi2, $ekstensi_diperbolehkan2) === true) 
				{
					if ($ukuran2 < 2044070) 
					{
						move_uploaded_file($file_tmp2, 'public/img_sertifikat/'.$randomname2);
						$inputsql = "
							INSERT INTO tb_property
							(judul, alamat, daerah, luas_bangunan, luas_tanah, jenis_property, harga, kamar_tidur, kamar_mandi, lantai, image_sertifikat, image, fasilitas, status_property, id_pemilik, id_agent)
							VALUES
							('$judul', '$alamat', '$daerah', '$luas_bangunan', '$luas_tanah', '$tipe', '$harga', '$kamar_tidur', '$kamar_mandi', '$lantai', '$randomname2', '$randomname', '$fasilitas', '$status', '$nama', '$agent')";
						$property = mysqli_query($conn, $inputsql);
						if ($property) 
						{
							echo " <script>alert('Success, Data Property Anda Sudah Diinput !'); </script> ";  
						}
						else
						{
							echo " <script>alert('Failed, Data Property Anda Gagal Diinput'); </script> ";  
						}	
					}
					else
					{
						echo " <script>alert('Failed, Ukuran Gambar Sertifikat Terlalu Besar !'); </script> ";  
					}
				}
				else
				{
					echo " <script>alert('Failed, Format Gambar Sertifikat Harus JPG Atau PNG !'); </script> ";
				}
			}
			else
			{
				echo " <script>alert('Failed, Ukuran Gambar Terlalu Besar !'); </script> ";
			}    	
    	}
    	else
    	{
    		echo " <script>alert('Failed, Format Gambar Harus JPG Atau PNG !'); </script> ";
    	}
    }


}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="Keywords" content="Cars">
		<meta name="Description" content="Tasting the cars">
		<title>CATUR PERKASALAND</title>
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Khula" />
		<link href='https://fonts.googleapis.com/css?family=Kodchasan' rel='stylesheet'>
		<link rel="stylesheet" href="css/cssreset-min.css"/>
		<link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" type="text/css" href="datatables/lib/css/dataTables.bootstrap.min.css"/>
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" media="screen" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="assets/js/menu.js"></script>
		<script src="https://use.fontawesome.com/f924bc844c.js"></script>
	</head>
	<body>
		<!-- Navbar -->
		<nav class="navbar navbar-expand-lg fixed-top navbar-light bg-white d-flex">
			<a class="navbar-brand justify-content-start me-auto ms-4 col-3" href="index.html">
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
							    	<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#ModalLaporan">
									  	Cetak Laporan 
									</button>
							    </li>
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
		                	<li class="nav-item m-4">
						    	<button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#ModalLogin">
								  	Login
								</button>
						    </li>
						    <li class="nav-item m-4">
								<a class="btn btn-secondary" id="dropdownMenuButton1" aria-expanded="false" href="register.php">
									Register
								</a>
						    </li>
		                ';
		            }
		            ?>
				</ul>
			</div>
		</nav>
		<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
			<div class="carousel-indicators">
			    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
			    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
			    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
			    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
			    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
			</div>
			<div class="carousel-inner">
			    <div class="carousel-item active img-slider">
			      <img src="assets/img/cont/rumah1.png" class="d-block w-100" alt="...">
			    </div>
			    <div class="carousel-item">
			      <img src="assets/img/cont/rumah2.png" class="d-block w-100" alt="...">
			    </div>
			    <div class="carousel-item">
			      <img src="assets/img/cont/rumah3.png" class="d-block w-100" alt="...">
			    </div>
			    <div class="carousel-item">
			      <img src="assets/img/cont/rumah4.png" class="d-block w-100" alt="...">
			    </div>
			    <div class="carousel-item">
			      <img src="assets/img/cont/rumah5.png" class="d-block w-100" alt="...">
			    </div>
				<div class="carousel-caption d-none d-md-block" style="bottom: 250px;">
			      	<div class="d-flex justify-content-center">
						<div class="row">
							<img src="assets/img/logo.png" class="mx-auto" style="width: 30%;">
							<h1>Selamat Datang!</h1>
							<p class="col-8 mx-auto">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
							consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
							cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
							proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						</div>
				   	</div>
				</div>
			</div>
			  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
			    	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
			    	<span class="visually-hidden">Previous</span>
			  </button>
			  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
			    <span class="carousel-control-next-icon" aria-hidden="true"></span>
			    <span class="visually-hidden">Next</span>
			  </button>
		</div>
		<?php
			error_reporting(0);
			$id = $_SESSION['login'];
			$cekusersql = "
				SELECT * FROM tb_user
				WHERE id = '$id'";
			$cekuser = mysqli_query($conn, $cekusersql);
			$datauser = mysqli_fetch_array($cekuser);
			
			$level = $datauser['level'];
			$namauser = $datauser['nama'];

			if ($level == '0') 
			{
				echo '
					<div class="container-fluid pt-4 pb-4">
						<div class="container">
							<div class="row p-2">
								<div class="p-2 text-center">
									<h1><b>Informasi Admin</b></h1>
								</div>
							</div>
						</div>
					</div>';
			}
			else if ($level == '1')
			{
				echo '
					<div class="container-fluid pt-4 pb-4">
						<div class="container">
							<div class="row p-2">
								<div class="p-2 text-center">
									<h1><b>Informasi Wilayah Anda</b></h1>
								</div>
								<div class="col-sm-6 p-3">
									<a href="property.php?id=Buleleng" class="nav-link item">
										<div class="card img-j d-flex justify-content-center">
											<img src="assets/img/cont/select-1.png" style="max-width:100%; margin: auto;">
											<h3 class="mx-auto text-center">Buleleng</h3>
										</div>
									</a>
								</div>
								<div class="col-sm-6 p-3">
									<a href="property.php?id=Jembrana" class="nav-link item">
										<div class="card img-j d-flex justify-content-center">
											<img src="assets/img/cont/select-2.png" style="max-width:100%; margin: auto;">
											<h3 class="mx-auto text-center">Jembrana</h3>
										</div>
									</a>
								</div>
								<div class="col-sm-6 p-3">
									<a href="property.php?id=Badung" class="nav-link item">
										<div class="card img-j d-flex justify-content-center">
											<img src="assets/img/cont/select-3.png" style="max-width:100%; margin: auto;">
											<h3 class="mx-auto text-center">Badung</h3>
										</div>
									</a>
								</div>
								<div class="col-sm-6 p-3">
									<a href="property.php?id=Denpasar" class="nav-link item">
										<div class="card img-j d-flex justify-content-center">
											<img src="assets/img/cont/select-4.png" style="max-width:100%; margin: auto;">
											<h3 class="mx-auto text-center">Denpasar</h3>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid pt-4 pb-4">
						<div class="container">
							<div class="row p-2">
								<div class="p-2 text-center">
									<h2><b>Agen Pilihan</b></h2>
								</div>
								<div class="col-sm-6 bg-abu">
									<a href="agen-detail.html" class="nav-link item">
										<div class="card p-3">
											<img src="assets/img/agen/agen.png" class="mx-auto" style="width: 15%;">
											<p class="text-center pt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
												quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
												consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
												cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
												proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
											</p>
											<hr class="col-6 mx-auto">
											<h3 class="mx-auto">Ariel Ardinata - Independent Agent</h3>
										</div>
									</a>
								</div>
								<div class="col-sm-6 bg-abu">
									<a href="agen-detail.html" class="nav-link item">
										<div class="card p-3">
											<img src="assets/img/agen/agen.png" class="mx-auto" style="width: 15%;">
											<p class="text-center pt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
												quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
												consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
												cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
												proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
											</p>
											<hr class="col-6 mx-auto">
											<h3 class="mx-auto">Ariel Ardinata - Independent Agent</h3>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>';
			}
			else if ($level == '2')
			{
				$html = '
					<div class="container-fluid pt-4 pb-4">
						<div class="container">
							<div class="row p-2">
								<div class="p-2 text-center">
									<h1><b>Informasi Agent '.$namauser.'</b></h1>
								</div>
							</div>
							<div class="row mt-3">
								<table id="example" class="table table-striped table-bordered" style="width:100%">
							        <thead>
							            <tr>
							                <th>Judul Property</th>
							                <th>Daerah</th>
							                <th>Jenis Property</th>
							                <th>Nama Pemilik</th>
							                <th>Harga</th>
							                <th>Status</th>
							                <th>Aksi</th>
							            </tr>
							        </thead>
							        <tbody>';

							        $propertyagentsql = "
							        	SELECT *, property.id AS id_property 
							        	FROM tb_property AS property
							        	INNER JOIN tb_user AS user 
							        	ON property.id_pemilik = user.id
							        	WHERE id_agent = '$id'";
							        $property = mysqli_query($conn, $propertyagentsql);
							        while ($dataproperty = mysqli_fetch_array($property)) 
							        {
							        	$status = $dataproperty['status_property'];
							        $html .='
							            <tr>
							                <td>'.$dataproperty['judul'].'</td>
							                <td>'.$dataproperty['daerah'].'</td>
							                <td>'.$dataproperty['jenis_property'].'</td>
							                <td>'.$dataproperty['nama'].'</td>
							                <td>Rp'.$dataproperty['harga'].'</td>
							                <td>'.$dataproperty['status_property'].'</td>
							                <td>';
							                if ($status == 'Sudah Terjual') 
							                {
							                	$html .='
							                	<a class="btn btn-success" href="detail-property.php?id='.$dataproperty['id_property'].'"><i class="fa fa-eye"></i></a>
							                	';
							                }
							                else
							                {
							                	$html .= '
							                	<a class="btn btn-success" href="detail-property.php?id='.$dataproperty['id_property'].'"><i class="fa fa-eye"></i></a>
							                	<a class="btn btn-info" href="validate.php?id='.$dataproperty['id_property'].'"> <i class="fa fa-check"></i></a>
							                	<a class="btn btn-danger" onClick="return confirm(\'Apakah anda ingin menghapus permintaan ini?\')" href="delete.php?id='.$dataproperty['id_property'].'"> <i class="fa fa-times"></i></a>';
							                }
							                	$html .='
							                </td>
							            </tr>';
							        }
							        $html .='
							        </tbody>
							        <tfoot>
							            <tr>
							                <th>Judul Property</th>
							                <th>Daerah</th>
							                <th>Jenis Property</th>
							                <th>Nama Pemilik</th>
							                <th>Harga</th>
							                <th>Status</th>
							                <th>Aksi</th>
							            </tr>
							        </tfoot>
							    </table>
							</div>
						</div>
					</div>';
				echo $html;
			}
			else
			{
				$html = '
					<div class="container-fluid pt-4 pb-4">
						<div class="container">
							<div class="row p-2">
								<div class="p-2 text-center">
									<h1><b>Informasi Wilayah Anda</b></h1>
								</div>
								<div class="col-sm-6 p-3">
									<a href="property.php?id=Buleleng" class="nav-link item">
										<div class="card img-j d-flex justify-content-center">
											<img src="assets/img/cont/select-1.png" style="max-width:100%; margin: auto;">
											<h3 class="mx-auto text-center">Buleleng</h3>
										</div>
									</a>
								</div>
								<div class="col-sm-6 p-3">
									<a href="property.php?id=Jembrana" class="nav-link item">
										<div class="card img-j d-flex justify-content-center">
											<img src="assets/img/cont/select-2.png" style="max-width:100%; margin: auto;">
											<h3 class="mx-auto text-center">Jembrana</h3>
										</div>
									</a>
								</div>
								<div class="col-sm-6 p-3">
									<a href="property.php?id=Badung" class="nav-link item">
										<div class="card img-j d-flex justify-content-center">
											<img src="assets/img/cont/select-3.png" style="max-width:100%; margin: auto;">
											<h3 class="mx-auto text-center">Badung</h3>
										</div>
									</a>
								</div>
								<div class="col-sm-6 p-3">
									<a href="property.php?id=Denpasar" class="nav-link item">
										<div class="card img-j d-flex justify-content-center">
											<img src="assets/img/cont/select-4.png" style="max-width:100%; margin: auto;">
											<h3 class="mx-auto text-center">Denpasar</h3>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid pt-4 pb-4">
						<div class="container">
							<div class="row p-2">
								<div class="p-2 text-center">
									<h2><b>Agen Pilihan</b></h2>
								</div>';
								$useragentsql = "
									SELECT * FROM tb_user
									WHERE level = '2'";
								$cekuseragent = mysqli_query($conn, $useragentsql);
								while ($datauseragent = mysqli_fetch_array($cekuseragent))
								{
								$html .='
								<div class="col-sm-6 bg-abu">
									<a href="agen-detail.php?id='.$datauseragent['id'].'" class="nav-link item">
										<div class="card p-3">
											<img src="assets/img/agen/agen.png" class="mx-auto" style="width: 15%;">
											<p class="text-center pt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
												tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
												quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
												consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
												cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
												proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
											</p>
											<hr class="col-6 mx-auto">
											<h3 class="mx-auto">'.$datauseragent['nama'].' - Independent Agent</h3>
										</div>
									</a>
								</div>';
								}
								$html .='
							</div>
						</div>
					</div>';
				echo $html;
			}

		?>
		
		
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

				<span class="d-flex justify-content-center">Developed and Optimized by Agus Yudi | &copy 2021 The Bali Estate, All Rights Reserved</span>
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

		<!-- Modal Laporan-->
		<div class="modal fade" id="ModalLaporan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      </div>
		      <div class="modal-body text-center">
					<img src="assets/img/logo.png" style="width: 40%;" class="">
		        <form method="post" action="laporan.php" target="_blank">
		        	<h1>Tahun Laporan</h1>
					<div class="form-group p-2">
					    <select class="form-select" aria-label="Default select example" name="tahun">
				        	<option value="2019">2019</option>
				        	<option value="2020">2020</option>
				        	<option value="2021">2021</option>
				      	</select>
					</div>
					<div class="form-group p-2">
						<input type="text" name="id" value="<?php echo $_SESSION['login']; ?>" hidden>
					</div>
					<button type="submit" class="btn btn-primary btn-lg  m-3 rounded-pill">Cari</button>
				</form>
		      </div>
		    </div>
		  </div>
		</div>

		<!-- Modal Login-->
		<div class="modal fade" id="ModalIklan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  	<div class="modal-dialog modal-lg">
		    	<div class="modal-content">
		      		<div class="modal-header">
		        		<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		      		</div>
		      		<div class="modal-body">
		      			<div class="text-center">
							<img src="assets/img/logo.png" style="width: 10%;" class="justify-content-center">
						</div>
				        <form method="post" enctype="multipart/form-data">
				        	<div class="row">
					        	<div class="col-sm-4">
								    <div class="form-group p-2">
								      	<label for="inputState">Tipe*</label>
								      	<select class="form-select" aria-label="Default select example" name="tipe">
								        	<option selected> Pilih</option>
								        	<option value="Rumah">Rumah</option>
								        	<option value="Apartemen">Apartmen</option>
								        	<option value="Villa">Villa</option>
								      	</select>
								    </div>
								    <div class="form-group p-2">
								      	<label for="inputState">Status*</label>
								      	<select class="form-select" aria-label="Default select example" name="status">
								        	<option selected> Pilih</option>
								        	<option value="Dijual">Dijual</option>
								        	<option value="Disewakan">Disewakan</option>
								      	</select>
								    </div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Luas Bangunan*</label>
									    <input type="text" class="form-control" placeholder="Luas Bangunan" name="luas_bangunan">
									</div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Luas Tanah*</label>
									    <input type="text" class="form-control" placeholder="Luas Tanah" name="luas_tanah">
									</div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Kamar Tidur*</label>
									    <input type="number" class="form-control" placeholder="Kamar Tidur" name="kamar_tidur">
									</div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Kamar Mandi*</label>
									    <input type="number" class="form-control" placeholder="Kamar Mandi" name="kamar_mandi">
									</div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Daerah*</label>
									    <select class="form-select" aria-label="Default select example" name="daerah">
										  	<option selected> Pilih</option>
										  	<option value="Buleleng">Buleleng</option>
										 	<option value="Jembrana">Jembrana</option>
										  	<option value="Badung">Badung</option>
										  	<option value="Denpasar">Denpasar</option>
										</select>
									</div>
					        	</div>
					        	<?php
					        		$id = $_SESSION['login'];
					        		$pemiliksql = "
					        			SELECT * FROM tb_user 
					        			WHERE id = '$id'";
					        		$pemilik = mysqli_query($conn, $pemiliksql);
					        		$datapemilik = mysqli_fetch_array($pemilik);
					        			$namapemilik = $datapemilik['nama'];
					        	?>	
					        	<div class="col-sm-4">
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Nama Pemilik*</label>
									    <input type="text" class="form-control" value="<?php echo $namapemilik; ?>" readonly="readonly">
									</div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Lantai*</label>
									    <input type="text" class="form-control" placeholder="Jumlah Lantai" name="lantai">
									</div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Fasilitas*</label>
									    <input type="text" class="form-control" placeholder="Fasilitas" name="fasilitas">
									</div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Alamat*</label>
									    <input type="text" class="form-control" placeholder="Alamat Property" name="alamat">
									</div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Add Title*</label>
									    <input type="text" class="form-control" placeholder="" name="judul">
									</div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Harga*</label>
									    <input type="text" class="form-control" placeholder="Harga" name="harga">
									</div>
									<div class="form-group p-2">
			    						<label for="exampleFormControl">Add Additional*</label>
									    <textarea type="text" class="form-control" name="deskripsi"></textarea> 
									</div>
					        	</div>
					        	<div class="col-sm-4">
					        		<div class="form-group p-2">
			    						<label for="exampleFormControl">Agent*</label>
									    <select class="form-select" aria-label="Default select example" name="agent">
										  	<option selected> Pilih</option>
										  	<?php
										  		$agentsql = "
										  			SELECT * FROM tb_user 
										  			WHERE level = '2'";
										  		$cekagent = mysqli_query($conn, $agentsql);
										  		while ($dataagent = mysqli_fetch_array($cekagent)) 
										  		{
										  	?>
										  	<option value="<?php echo $dataagent['id']; ?>"><?php echo $dataagent['nama']; ?></option>
										  	<?php 
										  		}
										  	?>
										</select>
									</div>
								  	<div class="form-group file-area p-2">
								        <label for="images">Lampirkan Gambar*</label>
								    	<input type="file" name="images" id="images" required="required"/>
								    	<div class="file-dummy">
								      		<div class="default">Please select some files</div>
								    	</div>
								  	</div>
								  	<div class="form-group file-area p-2">
								        <label for="images">Lampirkan Sertifikat*</label>
								    	<input type="file" name="images2" id="images" required="required"/>
								    	<div class="file-dummy">
								      		<div class="default">Please select some files</div>
								    	</div>
								  	</div>
								  	<div class="text-center">
						        		<button type="submit" class="btn btn-primary btn-lg m-3 rounded-pill" name="input">Kirim Iklan</button>
									</div>
					        	</div>
				        	</div>
						</form>
		      		</div>
		    	</div>
			</div>
		</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() 
		{
    		$('#example').DataTable();
		});
	</script>
	</body>
</html>




