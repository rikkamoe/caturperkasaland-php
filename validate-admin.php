<?php
include 'core/koneksi.php';
$id = $_GET['id'];
$validasiadminsql = "
	SELECT * FROM tb_property
	WHERE id = '$id'";
$validasiadmin = mysqli_query($conn, $validasiadminsql);
$validasi = mysqli_fetch_array($validasiadmin);
$status = $validasi['status_property'];
if ($status == 'Dijual - Admin')
{
	$ubahstatussql = "
		UPDATE tb_property
		SET status_property = 'Dijual' 
		WHERE id = '$id'";
	$ubahstatus = mysqli_query($conn, $ubahstatussql);
	if ($ubahstatus) 
	{
		echo " <script>alert('Success, Properti ini sudah tervalidasi !');window.location='index.php'; </script> ";
	}
	else
	{
		echo " <script>alert('Gagal, Properti ini gagal divalidasi !');window.location='index.php'; </script> ";
	}
}
else if ($status == 'Disewakan - Admin')
{
	$ubahstatussql2 = "
		UPDATE tb_property
		SET status_property = 'Disewakan' 
		WHERE id = '$id'";
	$ubahstatus2 = mysqli_query($conn, $ubahstatussql2);
	if ($ubahstatus2) 
	{
		echo " <script>alert('Success, Properti ini sudah tervalidasi !');window.location='index.php'; </script> ";
	}
	else
	{
		echo " <script>alert('Gagal, Properti ini gagal divalidasi !');window.location='index.php'; </script> ";
	}
}
?>