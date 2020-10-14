<?php
	include "../config/koneksi.php";

	if(isset($_POST['simpan'])){ //jika diklik save
		$sql = mysqli_query($koneksi, "INSERT INTO tb_kategori values('','$_POST[kategori]')");
		echo "<script>alert('Tersimpan Cyaa');document.location.href='kategori.php'</script>";
	}
	if(isset($_GET['hapus'])){
		$sql = mysqli_query($koneksi, "DELETE FROM tb_kategori WHERE kd_kategori='$_GET[kd_kategori]'");
		if($sql){
			echo "<script>alert('Terhapuskan Cyaa');document.location.href='kategori.php'</script>";
		}else{
			echo printf("Error: %s\n", mysqli_error($koneksi));
			exit();
		}
	}
	if(isset($_GET['edit'])){
		$sql = mysqli_query($koneksi, "SELECT * FROM tb_kategori WHERE kd_kategori='$_GET[kd_kategori]'");
		$edit = mysqli_fetch_array($sql);
	}
	if(isset($_POST['update'])){
		$sql = mysqli_query($koneksi, "UPDATE tb_kategori SET kategori='$_POST[kategori]' WHERE kd_kategori = '$_GET[kd_kategori]'");
		if($sql){
			echo "<script>alert('Update data Sukses');document.location.href = 'kategori.php'</script>";
		}else{
			echo "<script>alert('Update data gagal')</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola Kategori</title>
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body>
	<style type="text/css">	
body{
    background-repeat: no-repeat;
    background-size: cover;
    background:url(../style/fabric.jpg);
     font-family: arial;
 }
</style>
    <div class="nav">
    <ul>
<li><a href="index.php">Home</a></li>
<li><a href="kelola_user.php">Kelola User</a></li>
<li><a href="form_menu.php">Menu</a></li>
<li><a href="kategori.php">Kategori</a></li>
<li><a href="laporan.php">Laporan</a></li>
</ul>
</div>
	<h2>CRUD CRUD MALAZ</h2>
	<div align="right">
		<a href="../login.php" style="color:black; margin-right:15px;"><u><b>Logout?</b></u></a>
	</div>
	<a href="index.php" style="color: black; margin-left: 15px;"><b>KEMBALI?</b></a>
	<h3 align="center">Tambah Kategori</h3>
	<form method="post">
		<table>
			<tr>			
				<td>Kategori</td>
				<td><input type="text" name="kategori" value="<?php echo @$edit['kategori'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="simpan" value="SIMPAN">
					<input type="submit" name="update" value="UPDATE"></td>
			</tr>		
		</table>
		<table>
		<tr><td><div class="input-group mb-3">
                <input placeholder="Search" type="search" name="tcari" class="form-control"  value="<?= @$_POST['tcari']; ?>" >
                <div class = "input-group-append">
                <input type="submit" name="cari" value="Cari" class="btn btn-success">
                </div>
            	</td>
            	</tr>
            	</table>
		<table border="1" cellpadding="11" cellspacing="0">
		<tr>
			<th>NO</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>
	</form>
	<?php 
		include '../config/koneksi.php';
		if(isset($_POST['cari'])){
			$data = mysqli_query($koneksi,"SELECT * FROM tb_kategori");
                    $data = mysqli_query($koneksi,"SELECT * FROM tb_kategori WHERE kategori LIKE '%$_POST[tcari]%'");
                }else{
                	$data = mysqli_query($koneksi,"SELECT * FROM tb_kategori");
                }
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $d['kd_kategori']; ?></td>
				<td><?php echo $d['kategori']; ?></td>
				<td>
					<a href="kategori.php?edit&kd_kategori=<?php echo $d['kd_kategori']; ?>">EDIT</a>
					<a href="kategori.php?hapus&kd_kategori=<?php echo $d['kd_kategori']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
</body>
</body>
</html>