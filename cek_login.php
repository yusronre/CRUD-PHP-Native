<?php 
session_start();
 
include 'config/koneksi.php';
 
$username = $_POST['username'];
$password = $_POST['password'];
 
 
$login = mysqli_query($koneksi, "SELECT * from tb_user where username='$username' and password='$password'");
$cek = mysqli_num_rows($login);
 
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	if($data['level']=="Admin"){
 
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		header("location:admin/index.php");
 
	}else if($data['level']=="Kasir"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "kasir";
		header("location:kasir/index.php");
 
	}else{
		header("location:login.php?pesan=gagal");
	}	
}else{
	header("location:login.php?pesan=gagal");
}
 
?>