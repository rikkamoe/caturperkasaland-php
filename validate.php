<?php
include 'core/koneksi.php';
$id = $_GET['id'];
$validasisql = "
	UPDATE tb_property 
	SET status_property = 'Sudah Terjual' 
	WHERE id = '$id'";
$validasi = mysqli_query($conn, $validasisql);
if ($validasi) 
{
	echo " <script>alert('Success, Properti ini sudah diubah menjadi Sudah Terjual !');window.location='index.php'; </script> ";
}
else
{
	echo " <script>alert('Gagal, Properti ini gagal diubah menjadi Sudah Terjual !');window.location='index.php'; </script> ";
}
?>