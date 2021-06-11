<?php
include 'core/koneksi.php';
$id = $_GET['id'];
$validasisql = "
	DELETE FROM tb_property
	WHERE id = '$id'";
$validasi = mysqli_query($conn, $validasisql);
if ($validasi) 
{
	echo " <script>alert('Success, Properti ini sudah dihapus !');window.location='index.php'; </script> ";
}
else
{
	echo " <script>alert('Gagal, Properti ini gagal dihapus !');window.location='index.php'; </script> ";
}

?>