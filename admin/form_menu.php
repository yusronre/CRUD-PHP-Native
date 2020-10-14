<?php
	include "../config/koneksi.php";

	if(isset($_POST['simpan'])){ //jika diklik save
		$sql = mysqli_query($koneksi, "INSERT INTO tb_menu values('','$_POST[menu]','$_POST[jenis]','$_POST[harga]','$_POST[status]','$_POST[foto]','$_POST[kategori]')");
		if($sql){
		echo "<script>alert('Tersimpan Cyaa');document.location.href='form_menu.php'</script>";
		}else{
			echo printf("Error: %s\n", mysqli_error($koneksi));
			exit();
		}
	}
	if(isset($_GET['hapus'])){
		$sql = mysqli_query($koneksi, "DELETE FROM tb_menu WHERE kd_menu='$_GET[kd_menu]'");
		echo "<script>alert('Terhapuskan Cyaa');document.location.href='form_menu.php'</script>";
	}
	if(isset($_GET['edit'])){
		$sql = mysqli_query($koneksi, "SELECT * FROM tb_menu WHERE kd_menu='$_GET[kd_menu]'");
		$edit = mysqli_fetch_array($sql);
	}
	if(isset($_POST['update'])){
		$sql = mysqli_query($koneksi, "UPDATE tb_menu SET menu='$_POST[menu]', jenis= '$_POST[jenis]', harga='$_POST[harga]', status='$_POST[status]', foto='$_POST[foto]' WHERE kd_menu = '$_GET[kd_menu]'");
		if($sql){
			echo "<script>alert('Update data Sukses');document.location.href = 'form_menu.php'</script>";
		}else{
			echo "<script>alert('Update data gagal')</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Form Menu</title>
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
<li><a href="kelola_user.php">Kelola user</a></li>
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
	<h3 align="center">Tambah menu</h3>
	<form method="post">
		<table>
			<tr>			
				<td>Menu</td>
				<td><input type="text" name="menu" value="<?php echo @$edit['menu']?>"></td>
			</tr>
			<tr>
				<td>Jenis</td>
				<td><input type="text" name="jenis" value="<?php echo @$edit['jenis']?>"></td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="number" name="harga" value="<?php echo @$edit['harga']?>"></td>
			</tr>
			<tr>
				<td>Status</td>
				<td><input type="text" name="status" value="<?php echo @$edit['status']?>"></td>
			</tr>
			<tr>
				<td>Foto</td>
				<td><input type="file" name="foto">
			</tr>
			<tr>
				<td>Kategori</td>
				<td><select name="kategori" style="width: 294px;font-size:16px;">
						<option>-Pilih-</option>
						<?php $sql=mysqli_query($koneksi, "SELECT * FROM tb_kategori"); 
						while($dataa = mysqli_fetch_array($sql)){
						?>
						<option value="<?php echo $dataa[0]?>"><?php echo $dataa[1] ?></option>
						<?php } ?>

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
			<th>Menu</th>
			<th>No.HP</th>
			<th>Harga</th>
			<th>Status</th>
			<th>Foto</th>
			<th>Kategori</th>
			<th>Aksi</th>
		</tr>
	</form>
	<?php 
		include '../config/koneksi.php';
		$data = mysqli_query($koneksi,"SELECT * FROM tb_menu");
				if(isset($_POST['cari'])){
                    $data = mysqli_query($koneksi,"SELECT * FROM tb_menu WHERE menu LIKE '%$_POST[tcari]%'");
                }else{
                	$data = mysqli_query($koneksi,"SELECT * FROM tb_menu");
                }
		while($d = mysqli_fetch_array($data)){
			?>
			<tr align="center">
				<td><?php echo $d[0]; ?></td>
				<td><?php echo $d[1]; ?></td>
				<td><?php echo $d[2]; ?></td>
				<td><?php echo $d[3]; ?></td>
				<td><?php echo $d[4]; ?></td>
				<td ><img src="../images/<?php echo $d[5]; ?>" width="60" height="50"></td>
				<td><?php echo $d[6]; ?></td>
				<td>
					<a href="form_menu.php?edit&kd_menu=<?php echo $d['kd_menu']; ?>">EDIT</a>
					<a href="form_menu.php?hapus&kd_menu=<?php echo $d['kd_menu']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
</body>
</body>
</html>