<?php
	include "../config/koneksi.php";

	if(isset($_POST['simpan'])){ //jika diklik save
		$sql = mysqli_query($koneksi, "INSERT INTO tb_user values('','$_POST[nama]','$_POST[nohp]','$_POST[username]','$_POST[password]','$_POST[level]')");
		echo "<script>alert('Tersimpan Cyaa');document.location.href='kelola_user.php'</script>";
	}
	if(isset($_GET['hapus'])){
		$sql = mysqli_query($koneksi, "DELETE FROM tb_user WHERE kd_user='$_GET[kd_user]'");
		echo "<script>alert('Terhapuskan Cyaa');document.location.href='kelola_user.php'</script>";
	}
	if(isset($_GET['edit'])){
		$sql = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE kd_user='$_GET[kd_user]'");
		$edit = mysqli_fetch_array($sql);
	}
	if(isset($_POST['update'])){
		$sql = mysqli_query($koneksi, "UPDATE tb_user SET nama='$_POST[nama]', nohp= '$_POST[nohp]', username='$_POST[username]', password='$_POST[password]', level='$_POST[level]' WHERE kd_user = '$_GET[kd_user]'");
		if($sql){
			echo "<script>alert('Update data Sukses');document.location.href = 'kelola_user.php'</script>";
		}else{
			echo "<script>alert('Update data gagal')</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Kelola User</title>
    <link rel="stylesheet" href="../style/index.css">
    <link rel="stylesheet" type="text/css" href="../style/style.css">
</head>
<body><style type="text/css">
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
	<h3 align="center">Tambah User</h3>
	<form method="post">
		<table>
			<tr>			
				<td>Nama</td>
				<td><input type="text" name="nama" value="<?php echo @$edit['nama']?>"></td>
			</tr>
			<tr>
				<td>No.HP</td>
				<td><input type="text" name="nohp" value="<?php echo @$edit['nohp']?>"></td>
			</tr>
			<tr>
				<td>Username</td>
				<td><input type="text" name="username" value="<?php echo @$edit['username']?>"></td>
			</tr>
			<tr>
				<td>Password</td>
				<td><input type="text" name="password" value="<?php echo @$edit['password']?>"></td>
			</tr>
			<tr>
				<td>Level</td>
				<td><select type="text" name="level">
					<option>admin</option>
					<option>kasir</option>
				</select></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="simpan" value="SIMPAN">
					<input type="submit" name="update" value="UPDATE"></td>
            	</div>
            </div>
			</tr>
                <br>
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
		<table border="1" cellpadding="11" cellspacing="2" style="width: 500px;">
            	
		<tr>
			<th>NO</th>
			<th>Nama</th>
			<th>No.HP</th>
			<th>Username</th>
			<th>Password</th>
			<th>Level</th>
			<th>Aksi</th>
		</tr>
	</form>
	<?php 
		include '../config/koneksi.php';
		$data = mysqli_query($koneksi,"SELECT * FROM tb_user");
				if(isset($_POST['cari'])){
                    $data = mysqli_query($koneksi,"SELECT * FROM tb_user WHERE username LIKE '%$_POST[tcari]%'");
                }else{
                	$data = mysqli_query($koneksi,"SELECT * FROM tb_user");
                }
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $d['kd_user']; ?></td>
				<td><?php echo $d['nama']; ?></td>
				<td><?php echo $d['nohp']; ?></td>
				<td><?php echo $d['username']; ?></td>
				<td><?php echo $d['password']; ?></td>
				<td><?php echo $d['level']; ?></td>
				<td>
					<a href="kelola_user.php?edit&kd_user=<?php echo $d['kd_user']; ?>">EDIT</a>
					<a href="kelola_user.php?hapus&kd_user=<?php echo $d['kd_user']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
</body>
</body>
</html>